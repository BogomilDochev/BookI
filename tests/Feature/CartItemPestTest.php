<?php

use App\Models\Book;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

beforeEach(function() {
    $this->user = User::factory()->create([]);
    actingAs($this->user);
});

test('cart page contains non empty table', function () {
    $cartItem = CartItem::factory()->create([
        'user_id' =>   $this->user->id,
    ]);

    get(route('cart'))
        ->assertStatus(200)
        ->assertDontSee('No books in the cart');
});

it('creates cart item', function() {
    $book = Book::factory()->create();

    post(route('cart.store', $book->slug), [
        'book_id' => $book->id,
        'user_id' => $this->user->id
    ])->assertRedirect(session()->previousUrl())
      ->assertSessionHas('success', 'The item was added to the cart');

    $cartItem = CartItem::latest()->first();

    expect($cartItem->book_id)->toBe($book->id);
    expect($cartItem->user_id)->toBe($this->user->id);
});

it('deletes cart item', function () {
    $cartItem = CartItem::factory()->create();

    assertDatabaseHas('cart_items', [
        'book_id' => $cartItem->book_id,
        'user_id' => $cartItem->user_id,
        'product_quantity' => $cartItem->product_quantity
    ]);

    delete(route('cart.delete', $cartItem->id))
        ->assertRedirect(session()->previousUrl())
        ->assertSessionHas('success', 'Book removed from cart!');

    assertDatabaseMissing('cart_items', [
        'book_id' => $cartItem->book_id,
        'user_id' => $cartItem->user_id,
        'product_quantity' => $cartItem->product_quantity
    ]);
});

it('deletes all cart items', function () {
    $cartItems = CartItem::factory(5)->create();

    assertDatabaseCount('cart_items', 5);

    delete(route('cart.delete.all'))
        ->assertRedirect(session()->previousUrl())
        ->assertSessionHas('success', 'Congratulations, you bought the books!');

    assertDatabaseCount('cart_items', 0);
});

it('increases quantity of specific cart item', function () {
    $cartItem = CartItem::factory()->create([
        'product_quantity' => 4
    ]);

    patch(route('cart.increase', $cartItem->id));

    assertDatabaseHas('cart_items', [
        'book_id' => $cartItem->book_id,
        'user_id' => $cartItem->user_id,
        'product_quantity' => 5
    ]);

    patch(route('cart.increase', $cartItem->id))
        ->assertSessionHas('error', 'You cannot buy more than 5 books');
});

it('cannot increases quantity of specific cart item more than what has in stock', function () {
    $book = Book::factory()->create([
        'in_stock_quantity' =>3
    ]);
    $cartItem = CartItem::factory()->create([
        'book_id' => $book->id,
        'product_quantity' => 3
    ]);

    patch(route('cart.increase', $cartItem->id))
        ->assertSessionHas('error', 'Not enough books in stock');
});

it('decreases quantity of specific cart item', function () {
    $cartItem = CartItem::factory()->create([
        'product_quantity' => 2
    ]);

    patch(route('cart.decrease', $cartItem->id));

    assertDatabaseHas('cart_items', [
        'book_id' => $cartItem->book_id,
        'user_id' => $cartItem->user_id,
        'product_quantity' => 1
    ]);

    patch(route('cart.decrease', $cartItem->id))
        ->assertSessionHas('success', 'Book removed from cart!');
});

it('cannot put more book in the cart than what has in stock', function () {
    $book = Book::factory()->create([
       'in_stock_quantity' => 2
    ]);

    post(route('cart.store', $book->slug), [
        'book_id' => $book->id,
        'user_id' => $this->user->id,
        'quantity' => 3
    ])->assertRedirect(session()->previousUrl())
        ->assertSessionHas('error', 'There are not that many books in stock');
});

it('cannot put more than 5 same books in the cart', function () {
    $book = Book::factory()->create();

    post(route('cart.store', $book->slug), [
        'book_id' => $book->id,
        'user_id' => $this->user->id,
        'quantity' => 6
    ])->assertRedirect(session()->previousUrl())
        ->assertSessionHas('error', 'You cannot buy more than 5 books');
});

it('cannot put the same book in the cart twice', function () {
    $book = Book::factory()->create();

    post(route('cart.store', $book->slug), [
        'book_id' => $book->id,
        'user_id' => $this->user->id
    ])->assertRedirect(session()->previousUrl())
        ->assertSessionHas('success', 'The item was added to the cart');

    post(route('cart.store', $book->slug), [
        'book_id' => $book->id,
        'user_id' => $this->user->id
    ])->assertRedirect(session()->previousUrl())
        ->assertSessionHas('error', 'The item has already been added to the cart');
});
