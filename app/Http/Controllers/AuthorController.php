<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Author';
        $authors = Author::latest()->paginate(9);
        return view('dashboard.author.index', compact('authors', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Author';
        return view('dashboard.author.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|min:2|string|max:255|unique:authors',
            'slug' => 'required|string|max:255|unique:authors'
        ]);

        Author::create($validate);
        return redirect('/dashboard/author')->with('success', 'Author created successfully.');
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
    public function edit(Author $author)
    {
        $title = 'Edit Author';
        return view('dashboard.author.edit', compact('title', 'author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $rules = [
            'name' => 'required|min:2|string|max:255|'
        ];

        if ($request->slug != $author->slug){
            $rules['slug'] = 'required|string|max:255|';
        }

        $validate = $request->validate($rules);
        $author->update($validate);
        return redirect('/dashboard/author')->with('success', 'Author updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect('/dashboard/author')->with('success', 'Author deleted successfully.');
    }
}
