<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = (new BookController)->numberOfFavorites();


        return view('favorites.index', [
            'favoriteBooks' => Favorite::all()->where('user_id','=', auth()->id()),
            'favorites' => $favorites
        ]);
    }

    public function store(Book $book)
    {
        try {
            //add a book to favorites of the logged in person
            $book->favorites()->create([
                'user_id' => auth()->id(),
            ]);

            return back();
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('error', 'The item was already added to favorites');
        }

    }

    public function destroy(Favorite $favorite)
    {
        $favorite->delete();

        return back()->with('success', 'Book removed from favorites!');
    }
}
