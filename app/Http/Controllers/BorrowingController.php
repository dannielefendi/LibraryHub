<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    // User Section

    // Display all available books
    public function index(Request $request) 
    {
        $totalFine = Borrowing::where('user_id', Auth::id())
            ->where('fine_remaining', '>', 0)
            ->sum('fine_remaining');

        $categories = Category::all();

        $books = Book::with('categories')
            ->where('stock', '>', 0)
            ->when($request->categories, function($query, $categories) {
                $query->whereHas('categories', function($q) use ($categories) {
                    $q->whereIn('categories.id', $categories); // <- ganti where jadi whereIn
                },'=',  count($categories));
            })

            ->when($request->search, function($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
                });
            })
            
            ->paginate(6)
            ->withQueryString();

        $noBooks = $books->total() === 0;

        return view('user.dashboard', compact('books', 'totalFine', 'categories', 'noBooks'));
    }

    // User requests to borrow a book
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'book_id' => 'required|exists:books,id',
    //     ]);

    //     $book = Book::findOrFail($request->book_id);

    //     // Check stock availability
    //     if ($book->stock <= 0) {
    //         return back()->with('error', 'Book stock is empty!');
    //     }

    //     // Check if user already borrowed or has a pending request for this book
    //     $existing = Borrowing::where('user_id', Auth::id())
    //         ->where('book_id', $book->id)
    //         ->whereIn('status', ['Pending', 'Borrowed'])
    //         ->first();

    //     if ($existing) {
    //         return back()->with('error', 'You already borrowed or requested this book.');
    //     }

    //     // Create borrowing request (status: Pending)
    //     Borrowing::create([
    //         'user_id' => Auth::id(),
    //         'book_id' => $book->id,
    //         'status' => 'Pending',
    //         'borrow_date' => now(),
    //     ]);

    //     return back()->with('success', 'Borrow request submitted. Waiting for admin approval.');
    // }

    // User directly borrows a book without approval
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

        // Check if user already borrowed this book and hasn't returned it
        $existing = Borrowing::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['Borrowed', 'Late'])
            ->first();

        if ($existing) {
            return back()->with('error', 'You already borrowed this book.');
        }

        
        // User can only borrow 3 books
        $totalBorrowed = Borrowing::where('user_id', Auth::id())
            ->where('status', ['Borrowed', 'Late'])
            ->count();

        if ($totalBorrowed >= 3) {
            return back()->with('error', 'You can only borrow a maximum of 3 books.');
        }

        $fine_remaining = Borrowing::where('user_id', Auth::id())
            ->where('fine_remaining', '>', 0)
            ->sum('fine_remaining');

        if ($fine_remaining > 0) {
        return back()->with(
            'error',
            'Please Pay Your Fine First. Total fine: Rp ' . number_format($fine_remaining, 0, ',', '.')
        );
}


        // Create borrowing directly as Borrowed
        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'status' => 'Borrowed',   // langsung borrowed
            'borrow_date' => now(),
            'due_date'   => now()->addDays(14),
        ]);

        // Reduce stock immediately
        $book->decrement('stock');

        return back()->with('success', 'Book borrowed successfully.');
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


    // Admin Section

    // Display all borrowings
    public function adminIndex()
    {
        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();
        return view('admin.borrowings.index', compact('borrowings'));
    }

    // // Admin approves a borrowing
    // public function approve($id)
    // {
    //     $borrowing = Borrowing::findOrFail($id);
    //     $book = $borrowing->book;

    //     // Check stock availability
    //     if ($book->stock <= 0) {
    //         return back()->with('error', 'Book stock is empty. Cannot approve.');
    //     }

    //     $borrowing->update([
    //         'status' => 'Borrowed',
    //         'borrow_date' => now(),
    //     ]);

    //     // Decrease book stock
    //     $book->decrement('stock');

    //     return back()->with('success', 'Borrowing approved successfully.');
    // }

    // // Admin rejects a borrowing
    // public function reject($id)
    // {
    //     $borrowing = Borrowing::findOrFail($id);
    //     $borrowing->update([
    //         'status' => 'Rejected',
    //     ]);

    //     return back()->with('info', 'Borrowing request has been rejected.');
    // }

    // Admin marks a book as returned
    public function markReturned($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $book = $borrowing->book;

        $today = Carbon::now();
        $dueDate = Carbon::parse($borrowing->due_date);

        // Hitung keterlambatan
        $lateDays = 0;
        $finePerDay = 2000;
        $fineTotal = 0;

        if ($today->greaterThan($dueDate)) {
            $lateDays = $dueDate->startOfDay()->diffInDays($today->startOfDay());
            $fineTotal = (int) $lateDays * (int) $finePerDay;
        }

        $book->increment('stock');

        $borrowing->update([
            'status'         => 'Returned',
            'return_date'    => now(),
            'late_days'      => $lateDays,
        ]);

        $message = $lateDays > 0 
            ? "Book returned late ($lateDays days). Total fine: Rp ".number_format($fineTotal)
            : "Book returned on time. No fine.";

        return back()->with('success', $message);
    }

   public function payFine(Request $request, $id)
    {
        $borrow = Borrowing::findOrFail($id);

        $amount = (int) $request->input('amount');

        if ($amount > $borrow->fine_remaining) {
            return back()->with('error', 'Payment exceeds remaining fine!');
        }

        $borrow->update([
            'fine_remaining' => $borrow->fine_remaining - $amount
        ]);

        // Update status Unavailable jika masih ada fine_remaining
        $totalRemaining = Borrowing::where('user_id', $borrow->user_id)
            ->where('fine_remaining', '>', 0)
            ->sum('fine_remaining');

        if ($totalRemaining > 0) {
            // bisa diupdate di tabel user, misal $user->status = 'Unavailable'
        }

        return back()->with('success', 'Payment successful!');
    }

    // Optional: helper untuk hitung total denda user
    public static function totalFineRemaining($userId)
    {
        return Borrowing::where('user_id', $userId)
            ->where('fine_remaining', '>', 0)
            ->sum('fine_remaining');
    }


}
