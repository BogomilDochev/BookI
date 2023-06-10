<?php

use App\Models\Book;
use App\Models\FavoriteBook;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a favorite book belongs to a book', function () {
    $book = Book::factory()->create();
    $favoriteBook = FavoriteBook::factory()->create([
        'book_id' => $book->id
    ]);

    expect($favoriteBook->book)->toBeInstanceOf(Book::class);
});

test('a favorite book belongs to a user', function () {
    $user = User::factory()->create();
    $favoriteBook = FavoriteBook::factory()->create([
        'user_id' => $user->id
    ]);

    expect($favoriteBook->user)->toBeInstanceOf(User::class);
});
