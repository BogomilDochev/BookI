<?php

use App\Models\Book;
use App\Models\FavoriteBook;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

test('favorite page contains empty table', function () {
    artisan('db:seed');
    actingAs(User::factory()->create());

    get(route('favorites'))
        ->assertStatus(200)
        ->assertSee('No books in favorites');
});

test('create favorite book', function () {
    actingAs($user = User::factory()->create());

    $book = Book::factory()->create();
    $favoriteBook = [
        'book_id' => $book->id,
        'user_id' => $user->id,
    ];

    post(route('favorites.store', $book->slug), $favoriteBook)
        ->assertStatus(302)
        ->assertRedirect(session()->previousUrl());

    assertDatabaseHas('favorite_books', $favoriteBook);
});

test('cannot add book to favorites twice', function () {
    actingAs($user = User::factory()->create());

    $book = Book::factory()->create();
    $favoriteBook = [
        'book_id' => $book->id,
        'user_id' => $user->id,
    ];

    post(route('favorites.store', $book->slug), $favoriteBook)
        ->assertSessionHas('success', 'The item was added to favorites');

    post(route('favorites.store', $book->slug), $favoriteBook)
        ->assertSessionHas('error', 'The item was already added to favorites');
});

test('delete favorite book', function () {
    actingAs($user = User::factory()->create());

    $favoriteBook = FavoriteBook::factory()->create();

    assertDatabaseHas('favorite_books', [
        'book_id' => $favoriteBook->book_id,
        'user_id' => $favoriteBook->user_id,
    ]);

    delete(route('favorites.delete', $favoriteBook->id))
        ->assertStatus(302)
        ->assertRedirect(session()->previousUrl());

    assertDatabaseMissing('favorite_books', [
        'book_id' => $favoriteBook->book_id,
        'user_id' => $favoriteBook->user_id,
    ]);
});

