<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\call;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Book | Index";
        $books = Book::latest()->paginate(9);

        return view('dashboard.book.index', compact('title', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Book | Create";
        $categories = Category::all();
        $authors = Author::all();

        return view('dashboard.book.create', compact('title', 'categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|unique:books,slug',
            'body' => 'required',
            'published_at' => 'date',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id'
        ]);


        if ($request->file('cover')) {
            $validatedData['cover'] = $request->file('cover')->store('book-covers', 'public');
        }

        Book::create($validatedData);
        return redirect('/dashboard/book')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $title = "Book | Edit";
        $categories = Category::all();
        $authors = Author::all();

        return view('dashboard.book.edit', compact('title', 'categories', 'authors', 'book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {

        $rules = [
            'name' => 'required|max:255',
            'body' => 'required',
            'published_at' => 'date',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id'
        ];

        if ($request->slug != $book->slug) {
            $rules['slug'] = 'required|unique:books,slug';
        }





        $validatedData = $request->validate($rules);


        if ($request->hasFile('cover')) {
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }
            $validatedData['cover'] = $request->file('cover')->store('book-covers', 'public');
        }

        $book->update($validatedData);
        return redirect('/dashboard/book')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }

        Book::destroy($book->id);
        return redirect('/dashboard/book')->with('success', 'Book deleted successfully.');
    }
}
