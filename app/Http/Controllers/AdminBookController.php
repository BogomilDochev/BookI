<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBookController extends Controller
{
    public function index()
    {
        $favorites = (new BookController)->numberOfFavorites();

        return view('admin.books.index', [
            'books' => Book::latest()->filter(
                request(['search'])
            )->paginate(50)->withQueryString(),
            'favorites' => $favorites
        ]);
    }

    public function create()
    {
        $favorites = (new BookController)->numberOfFavorites();


        return view('admin.books.create', [
            'favorites' => $favorites
        ]);
    }

    public function store()
    {
        $book = new Book();

        $attributes = request()->validate([
//            'cover' => [],
            'title' => 'required',
            'slug' => ['required', Rule::unique('books', 'slug')->ignore($book)],
            'author' => 'required',
            'publisher' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'description' => 'required',
            'price' => 'required',
            'date' => 'required|date_format:"Y-m-d',
            'pages' => 'required',
            'dimensions' => 'required',
            'languages' => 'required',
            'type' => 'required'
        ]);

//        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Book::create($attributes);

        return redirect('/')->with('success', 'New book has been added.');
    }

    public function edit(Book $book)
    {
        $favorites = (new BookController)->numberOfFavorites();

        return view('admin.books.edit', [
            'book' => $book,
            'favorites' => $favorites
        ]);
    }

    public function update(Book $book)
    {
        $attributes = request()->validate([
//            'cover' => [],
            'title' => 'required',
            'slug' => ['required', Rule::unique('books', 'slug')->ignore($book)],
            'author' => 'required',
            'publisher' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'description' => 'required',
            'price' => 'required',
            'date' => 'required|date_format:"Y-m-d',
            'pages' => 'required',
            'dimensions' => 'required',
            'languages' => 'required',
            'type' => 'required'
        ]);

        $book->update($attributes);

        return back()->with('success', 'Book Updated!');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return back()->with('success', 'Book Deleted!');
    }
}
