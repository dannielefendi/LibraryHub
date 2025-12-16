<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::with('categories')->get();
        // jumlah buku
        $totalBooks = Book::count();

        // jumlah kategori
        $totalCategories = Category::count();

        // jumlah stock (total semua buku)
        $totalStock = Book::sum('stock');


        return view('books.index', compact(
            'totalBooks',
            'totalCategories',
            'totalStock',
            'books',
        ));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('books.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
            'stock' => 'required|integer',
            'synopsis' => 'nullable|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'image_cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        // dd('Controller terpanggil!', $request->all());

        // Book::create($request->all());

        // Menyimpan data ke database
        $data = $request->all();
        if ($request->hasFile('image_cover')) {
            $data['image_cover'] = $request->file('image_cover')->store('book_covers', 'public');
        }

        $data['admin_id'] = auth()->id();
        $categories = $data['categories'];
        unset($data['categories']);
        $book = Book::create($data);
        $book->categories()->attach($categories);

        // Redirect ke halaman daftar buku dengan pesan sukses
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required|integer',
            'stock' => 'required|integer',
            'synopsis' => 'nullable|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            'image_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image_cover')) {
            // Hapus gambar lama jika ada
            if ($book->image_cover) {
                Storage::disk('public')->delete($book->image_cover);
            }
            $data['image_cover'] = $request->file('image_cover')->store('book_covers', 'public');
        }

        $categories = $data['categories'];
        unset($data['categories']);
        $book->update($data);
        $book->categories()->sync($categories);

        return redirect()->route('books.index')->with('success', 'Data buku berhasil diperbarui!');
    }
    
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        if ($book->image_cover) {
            Storage::disk('public')->delete($book->image_cover);
        }
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }

    public function showUserBook(Book $book)
    {
        // Bisa tambahkan logic user-only, misal cek stock
        return view('user.show_book', compact('book'));
    }


}
