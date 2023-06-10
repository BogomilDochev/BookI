<?php

use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a user belongs to many cart items and favorite books', function () {
    $book = Book::factory()->create();
    $user = User::factory()->create();

    expect($user->favorites)->toBeInstanceOf(Collection::class);
    expect($user->cartItems)->toBeInstanceOf(Collection::class);
});

test('a user has many comments', function () {
    $user = User::factory()->create();
    $comments = Comment::factory(5)->create([
        'user_id' => $user->id
    ]);

    expect($user->comment->count())->toBe(5);
});
