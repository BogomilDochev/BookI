<?php

use App\Models\Book;
use App\Models\Category;
use App\Models\Comment;
use App\Models\OldSlug;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use function Pest\Laravel\assertDatabaseCount;

uses(RefreshDatabase::class);

test('books table has expected columns', function () {
    expect(Schema::hasColumns('books', [
        'id','category_id', 'author', 'publisher', 'slug', 'title', 'cover', 'description',
        'price', 'in_stock_quantity', 'date', 'pages', 'dimensions', 'languages', 'type'
    ]))->toBeTrue();
});

test('book has many comments', function () {
    $book = Book::factory()->create();
    Comment::factory(5)->create([
        'book_id' => $book->id
    ]);

    expect($book->comment->count())->toBe(5);
});

test('book has many old slugs', function () {
    $book = Book::factory()->create();
    OldSlug::factory(5)->create([
        'book_id' => $book->id
    ]);

    expect($book->oldSlugs->count())->toBe(5);
});

test('book belongs to a category', function () {
    $category = Category::factory()->create();
    $book = Book::factory()->create([
        'category_id' => $category->id
    ]);

    expect($book->category)->toBeInstanceOf(Category::class);
});

test('book belongs to many cart items and favorite books', function () {
    $book = Book::factory()->create();

    expect($book->favoritedBy)->toBeInstanceOf(Collection::class);
    expect($book->cartAddedBy)->toBeInstanceOf(Collection::class);
});

test('it creates old slug', function () {
    $book = Book::factory()->create();

    assertDatabaseCount('old_slugs', 0);

    (new Book())->createOldSlug($book);

    assertDatabaseCount('old_slugs', 1);
});
