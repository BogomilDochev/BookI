<?php

use App\Models\Book;
use App\Models\Category;
use App\Models\OldSlug;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\artisan;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\call;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;
use function PHPUnit\Framework\assertEquals;

uses(RefreshDatabase::class);

test('book page returns successful response', function () {
    $book = Book::factory()->create();

    get(route('book.show',  $book->slug))
        ->assertStatus(200);
});

test('main page returns successful response', function () {
    $book = Book::factory()->create();

    get(route('home'))
        ->assertStatus(200);
});

test('admin can see add book button', function () {
    actingAs(User::factory()->create([
        'is_admin' => true
    ]));

    get(route('cart'))
        ->assertStatus(200)
        ->assertSee('Add Book');
});

test('admin can access admin panel for books', function () {
    $user = User::factory()->create();
    $admin = User::factory()->create([
        'is_admin' => true
    ]);

    actingAs($admin)
        ->get(route('admin.books'))
        ->assertStatus(200);

    actingAs($user)
        ->get(route('admin.books'))
        ->assertStatus(403);
});

test('admin can access add book page', function () {
    $user = User::factory()->create();
    $admin = User::factory()->create([
        'is_admin' => true
    ]);

    actingAs($admin)
        ->get(route('books.create'))
        ->assertStatus(200);

    actingAs($user)
        ->get(route('books.create'))
        ->assertStatus(403);
});

test('admin can access edit book page', function () {
    $user = User::factory()->create();
    $admin = User::factory()->create([
        'is_admin' => true
    ]);
    $book = Book::factory()->create();

    actingAs($admin)
        ->get(route('books.edit', $book->id))
        ->assertStatus(200);

    actingAs($user)
        ->get(route('books.edit', $book->id))
        ->assertStatus(403);
});

test('book not in stock', function () {
    $book = Book::factory()->create([
        'in_stock_quantity' => 0
    ]);

    get(route('book.show', $book->slug))
        ->assertSee('In Stock: Not available');
});

test('create book successfully', function () {
    actingAs(User::factory()->create([
        'is_admin' => true
    ]));
    $category = Category::factory()->create();
    $book = [
        'title' => 'Invisible Man',
        'author' => 'Ralph Ellison',
        'in_stock_quantity' => 10,
        'publisher' => 'Vintage Books',
        'category_id' => $category->id,
        'description' => 'description',
        'price' => 12,
        'date' => '1995-01-01',
        'pages' => 200,
        'dimensions' => '5.18 x 0.99 x 7.93 inches',
        'languages' => 'English',
        'type' => 'Hardcover'
    ];

    post(route('books.store'), $book)
        ->assertStatus(302)
        ->assertRedirect(route('admin.books'));

    assertDatabaseHas('books', $book);

    $lastBook = Book::latest()->first();
    expect($lastBook->title)->toBe($book['title']);
    expect($lastBook->price)->toBe($book['price']);
});

test('update book successfully', function () {
    actingAs(User::factory()->create([
        'is_admin' => true
    ]));
    $book = Book::factory()->create();

    assertDatabaseHas('books', ['title' => $book->title]);

    patch(route('books.update', $book->id), [
        'title' => 'New title',
        'author' => 'New author',
        'in_stock_quantity' => 10,
        'publisher' => 'New publisher',
        'category_id' => 1,
        'description' => 'New description',
        'price' => 12,
        'date' => '1995-01-01',
        'pages' => 200,
        'dimensions' => '5.18 x 0.99 x 7.93 inches',
        'languages' => 'English',
        'type' => 'Hardcover'
    ])->assertStatus(302)
      ->assertRedirect(route('admin.books'));

    assertDatabaseHas('books', ['title' => 'New title']);
});

test('delete book', function () {
    actingAs(User::factory()->create([
        'is_admin' => true
    ]));
    $book = Book::factory()->create();

    assertDatabaseHas('books', ['title' => $book->title]);

    delete(route('books.delete', $book->id))
        ->assertStatus(302)
        ->assertRedirect(session()->previousUrl());

    assertDatabaseMissing('books', ['title' => $book->title]);
});

test('sorting by price', function () {
    $book = new Book;
    artisan('db:seed');
    $cheapestBook = Book::orderBy('price', 'ASC')->first();
    $theMostExpensiveBook = Book::orderBy('price', 'DESC')->first();

    call('GET', '/', ["sort"=>"price", "direction" => 'asc']);
    $firstBook = ($book)->sorting($book)->first();
    assertEquals($cheapestBook, $firstBook);

    call('GET', '/', ["sort"=>"price", "direction" => 'desc']);
    $firstBook = ($book)->sorting($book)->first();
    assertEquals($theMostExpensiveBook, $firstBook);
});

test('sorting by created_at', function () {
    $book = new Book;
    artisan('db:seed');
    $oldestBook = Book::orderBy('created_at', 'ASC')->first();
    $newestBook = Book::orderBy('created_at', 'DESC')->first();

    call('GET', '/', ["sort"=>"created_at", "direction" => 'asc']);
    $firstBook = ($book)->sorting($book)->first();
    assertEquals($oldestBook, $firstBook);

    call('GET', '/', ["sort"=>"created_at", "direction" => 'desc']);
    $firstBook = ($book)->sorting($book)->first();
    assertEquals($newestBook, $firstBook);
});

test('no sorting functionality', function () {
    call('GET', '/', ["sort"=>"", "direction" => ""]);

    $currentSort = (new Book)->currentSorting();

    assertEquals('Sort by:', $currentSort);
});

test('search functionality', function () {
    $book = new Book;
    artisan('db:seed');
    $allBooksInDatabase = count($book::all());

    call('GET', '/', ["search"=>""]);
    $searchedBooks = ($book)->sorting($book)->count();
    assertEquals($allBooksInDatabase, $searchedBooks);

    call('GET', '/', ["search"=>"The Lord Of The Rings"]);
    $searchedBooks = ($book)->sorting($book)->count();
    assertEquals(1, $searchedBooks);
});

test('category filter functionality', function () {
    $book = new Book;
    artisan('db:seed');
    $allBooksInDatabase = count($book::all());

    call('GET', '/', ["search"=>""]);
    $searchedBooks = ($book)->sorting($book)->count();
    assertEquals($allBooksInDatabase, $searchedBooks);

    call('GET', '/', ["category"=>"historical-fiction"]);
    $searchedBooks = ($book)->sorting($book)->count();
    assertEquals(2, $searchedBooks);
});

test('redirect if old slug is given', function () {
    $book = Book::factory()->create();
    $oldSlug = OldSlug::factory()->create([
        'book_id' => $book->id
    ]);

    get(route('book.show', $oldSlug->slug))
        ->assertStatus(302)
        ->assertRedirect(route('book.show', $book->slug));

    get(route('book.show', 'BookThatDoesntExist'))
        ->assertStatus(404);
});
