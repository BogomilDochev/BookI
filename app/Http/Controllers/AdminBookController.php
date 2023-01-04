<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBookController extends Controller
{
    public function index()
    {
        return view('admin.books.index', [
            'books' => Book::latest()->filter(
                request(['search'])
            )->paginate(50)->withQueryString(),
            'favorites' => (new Book)->numberOfFavorites()
        ]);
    }

    public function create()
    {
        if(request(['search'])) {
            return redirect('/');
        }

        return view('admin.books.create', [
            'favorites' => (new Book)->numberOfFavorites()
        ]);
    }

    public function store()
    {
        $book = new Book();

        $attributes = $this->validatingInputs($book);

        $attributes = $this->checkIfCoverExists($attributes);

        Book::create($attributes);

        return redirect('/')->with('success', 'New book has been added.');
    }

    public function edit(Book $book)
    {
        if(request(['search'])) {
            return redirect('/');
        }

        return view('admin.books.edit', [
            'book' => $book,
            'favorites' => (new BookController)->numberOfFavorites()
        ]);
    }

    public function update(Book $book)
    {
        $attributes = $this->validatingInputs($book);

        $attributes = $this->checkIfCoverExists($attributes);

        $book->update($attributes);

        return back()->with('success', 'Book Updated!');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return back()->with('success', 'Book Deleted!');
    }

    //Validating the inputs given from the user
    public function validatingInputs(Book $book): array
    {
        $attributes = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('books', 'slug')->ignore($book)],
            'cover' => 'nullable|image',
            'author' => 'required',
            'publisher' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'description' => 'required',
            'price' => 'required|numeric|min:0|max:999',
            'date' => 'required|date_format:"Y-m-d',
            'pages' => 'required',
            'dimensions' => 'required',
            'languages' => 'required',
            'type' => 'required'
        ]);
        return $attributes;
    }

    //Checks if cover exists and store it if exists
    public function checkIfCoverExists(array $attributes): array
    {
        if (array_key_exists('cover', $attributes)) {
            $attributes['cover'] = request()->file('cover')->store('books');
        }
        return $attributes;
    }

}
