<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        return view('books.index', [
            'books' => Book::all(),
            'categories' => Category::all()
        ]);
    }

    public function show(Book $book) {
        return view('books.show', [
           'book' => $book
        ]);
    }
}
