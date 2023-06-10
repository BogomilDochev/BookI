<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CartItem;
use App\Models\FavoriteBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteBookController extends Controller
{
    public function __construct(
        protected FavoriteBook $favorites,
        protected CartItem $cart
    ) {
    }

    public function index()
    {

        return view('favorites.index', [
            'favoriteBooks' => $this->favorites->latest()->where('user_id', '=', auth()->id())->paginate(8),
            'favorites' => $this->favorites->numberOfFavorites(),
            'numberOfCartItems' => $this->cart->numberOfCartItems()
        ]);
    }

    public function store(Book $book)
    {
        try {
            //add a book to favorites of the logged in person
            $favorite = new FavoriteBook();

            $favorite->book()->associate($book);
            $favorite->user()->associate(auth()->user());

            $favorite->save();

            return back()->with('success', 'The item was added to favorites');
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('error', 'The item was already added to favorites');
        }

    }

    public function destroy(FavoriteBook $favorite)
    {
        $favorite->delete();

        return back()->with('success', 'Book removed from favorites!');
    }
}
