<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * ======================
     * USER SECTION
     * ======================
     */

    // Display all available books
    public function index()
    {
        $books = Book::where('stock', '>', 0)->with('category')->get();
        return view('user.dashboard', compact('books'));
    }

    // User requests to borrow a book
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        // Check stock availability
        if ($book->stock <= 0) {
            return back()->with('error', 'Book stock is empty!');
        }

        // Check if user already borrowed or has a pending request for this book
        $existing = Borrowing::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['Pending', 'Borrowed'])
            ->first();

        if ($existing) {
            return back()->with('error', 'You already borrowed or requested this book.');
        }

        // Create borrowing request (status: Pending)
        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'status' => 'Pending',
            'borrow_date' => now(),
        ]);

        return back()->with('success', 'Borrow request submitted. Waiting for admin approval.');
    }

    // Show user's own borrowings
    public function showUserBorrowings()
    {
        $borrowings = Borrowing::where('user_id', Auth::id())
            ->with('book')
            ->latest()
            ->get();

        return view('user.borrowings', compact('borrowings'));
    }


    /**
     * ======================
     * ADMIN SECTION
     * ======================
     */

    // Display all borrowings
    public function adminIndex()
    {
        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();
        return view('admin.borrowings.index', compact('borrowings'));
    }

    // Admin approves a borrowing
    public function approve($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $book = $borrowing->book;

        // Check stock availability
        if ($book->stock <= 0) {
            return back()->with('error', 'Book stock is empty. Cannot approve.');
        }

        $borrowing->update([
            'status' => 'Borrowed',
            'borrow_date' => now(),
        ]);

        // Decrease book stock
        $book->decrement('stock');

        return back()->with('success', 'Borrowing approved successfully.');
    }

    // Admin rejects a borrowing
    public function reject($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->update([
            'status' => 'Rejected',
        ]);

        return back()->with('info', 'Borrowing request has been rejected.');
    }

    // Admin marks a book as returned
    public function markReturned($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $book = $borrowing->book;

        // Increase book stock
        $book->increment('stock');

        $borrowing->update([
            'status' => 'Returned',
            'return_date' => now(),
        ]);

        return back()->with('success', 'Book has been successfully returned.');
    }
}
