<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\CartItem;
use App\Models\FavoriteBook;
use App\Models\OldSlug;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBookController extends Controller
{
    public function __construct(
        protected Book $book,
        protected FavoriteBook $favorites,
        protected CartItem $cart
    ) {
    }

    public function index()
    {
        return view('admin.books.index', [
            'books' => $this->book->latest()->paginate(16),
            'favorites' => $this->favorites->numberOfFavorites(),
            'numberOfCartItems' => $this->cart->numberOfCartItems()
        ]);
    }

    public function create()
    {
        return view('admin.books.create', [
            'favorites' => $this->favorites->numberOfFavorites(),
            'numberOfCartItems' => $this->cart->numberOfCartItems()
        ]);
    }

    public function store(BookRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = str($validated['title'])->slug();
        if (array_key_exists('cover', $validated)) {
            $validated['cover'] = $request->file('cover')->store('books');
        }

        Book::create($validated);

        return redirect(route('admin.books'))->with('success', 'New book has been added.');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', [
            'book' => $book,
            'favorites' => $this->favorites->numberOfFavorites(),
            'numberOfCartItems' => $this->cart->numberOfCartItems()
        ]);
    }

    public function update(BookRequest $request, Book $book)
    {
        $this->book->createOldSlug($book);

        $validated = $request->validated();
        if (array_key_exists('cover', $validated)) {
            $validated['cover'] = $request->file('cover')->store('books');
        }
        $book->update($validated);

        return redirect(route('admin.books'))->with('success', 'Book Updated!');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return back()->with('success', 'Book Deleted!');
    }

}
