<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    // Daftar semua buku yang bisa dipinjam
    public function index()
    {
        $books = Book::where('stock', '>', 0)->with('category')->get();
        return view('user.dashboard', compact('books'));
    }

    // Simpan peminjaman
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku habis!');
        }

        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrow_date' => now(),
            'status' => 'Dipinjam',
        ]);

        // Kurangi stok buku
        $book->decrement('stock');

        return back()->with('success', 'Buku berhasil dipinjam!');
    }

    // Menampilkan daftar buku yang sedang user pinjam
    public function showUserBorrowings()
    {
        $borrowings = Borrowing::where('user_id', Auth::id())->with('book')->get();
        return view('user.borrowings', compact('borrowings'));
    }
}
