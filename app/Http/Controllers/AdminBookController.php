<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BuyItem;
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
            'favorites' => (new Book)->numberOfFavorites(),
            'cartItems' => (new BuyItem)->numberOfCartItems()
        ]);
    }

    public function create()
    {
        if(request(['search'])) {
            return redirect('/');
        }

        return view('admin.books.create', [
            'favorites' => (new Book)->numberOfFavorites(),
            'cartItems' => (new BuyItem)->numberOfCartItems()
        ]);
    }

    public function store()
    {
        $book = new Book();

        $attributes = $this->validatingInputs($book);

        $attributes['slug'] = $this->slugGenerator($attributes['title']);

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
            'favorites' => (new Book)->numberOfFavorites(),
            'cartItems' => (new BuyItem)->numberOfCartItems()
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
            'slug' => [Rule::unique('books', 'slug')->ignore($book)],
            'cover' => 'nullable|image',
            'author' => 'required',
            'publisher' => 'required',
            'quantity' => 'required|integer|min:0',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'description' => 'required',
            'price' => 'required|numeric|min:0|max:999',
            'date' => 'required|date_format:Y-m-d|before_or_equal:now',
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

    //Generates slug from the title of a book
    public function slugGenerator($title): string
    {
        $lowerCase = strtolower($title);

        $slug = str_replace(' ', '-', $lowerCase);

        return $slug;
    }

}
