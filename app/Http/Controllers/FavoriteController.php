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
        return view('favorites.index', [
            'favoriteBooks' => Favorite::latest()->where('user_id','=', auth()->id())->filter(
                request(['search']))->paginate(16)->withQueryString(),
            'favorites' => (new BookController)->numberOfFavorites()
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
