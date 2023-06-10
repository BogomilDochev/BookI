<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Book $book, CommentRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $validated['avatar'] = auth()->user()->avatar;

        $book->comment()->create($validated);

        return back();
    }
}
