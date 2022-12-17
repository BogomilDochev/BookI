<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Book $book)
    {
        try {
            //add a book to favorites of the logged in person
            $book->favorite()->create([
                'user_id' => auth()->id(),
            ]);

            return back();
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('error', 'The item was already added to favorites');
        }

    }
}
