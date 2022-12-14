<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Book $book)
    {
        //validation
        request()->validate([
            'body' => 'required'
        ]);

        //add a comment to a given post
        $book->comment()->create([
            'user_id' => auth()->id(),
            'body' => request('body'),
            'avatar' => Auth::user()->avatar
        ]);

        return back();
    }}
