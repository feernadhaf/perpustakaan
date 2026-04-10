<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $title = 'Homepage';
        $books = Book::latest('published_at')->paginate(3);

        $colorClasses = [
            'bg-sky-100 text-sky-500',
            'bg-green-100 text-green-500',
            'bg-yellow-100 text-yellow-500',
            'bg-pink-100 text-pink-500',
            'bg-indigo-100 text-indigo-500',
        ];

        foreach ($books as $book) {
            $categoryid = $book->category->id;
            $colorIndex = $categoryid % count($colorClasses);
            $book->category_color = $colorClasses[$colorIndex];
        }

        return view('home', compact('title', 'books'));
    }
}
