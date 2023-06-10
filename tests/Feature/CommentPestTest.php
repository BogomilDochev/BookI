<?php

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

test('it creates a new comment', function () {
    $book = Book::factory()->create();
    actingAs($user = User::factory()->create());
    $comment = [
        'user_id' => $user->id,
        'body' => 'This is the body of the comment',
        'avatar' => $user->avatar,
        'book_id' => $book->id,
    ];

    post(route('comment.add', $book->slug), $comment)
        ->assertStatus(302)
        ->assertRedirect(session()->previousUrl());

    assertDatabaseHas('comments', $comment);
});

