<?php

use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a category has many books', function () {
    $category = Category::factory()->create();
    Book::factory(5)->create([
        'category_id' => $category->id
    ]);

    expect($category->books->count())->toBe(5);
});
