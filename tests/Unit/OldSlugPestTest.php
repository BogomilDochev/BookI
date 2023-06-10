<?php

use App\Models\Book;
use App\Models\OldSlug;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('an old slug belongs to a book', function () {
    $book = Book::factory()->create();
    $oldSlug = OldSlug::factory()->create([
        'book_id' => $book->id
    ]);

    expect($oldSlug->book)->toBeInstanceOf(Book::class);
});
