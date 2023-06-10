<?php

use App\Models\Book;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function() {
    actingAs($user = User::factory()->create());

    $book = Book::factory()->create([
        'price' => 20
    ]);
    $book1 = Book::factory()->create([
        'price' => 13.30
    ]);

    $this->item = CartItem::factory()->create([
        'user_id' =>   $user->id,
        'book_id' => $book->id,
        'product_quantity' => 1
    ]);
    $item1 = CartItem::factory()->create([
        'user_id' =>   $user->id,
        'book_id' => $book1->id,
        'product_quantity' => 1
    ]);
});

test('a cart item belongs to a book', function () {
    expect($this->item->book)->toBeInstanceOf(Book::class);
});

test('a cart item belongs to a user', function () {
    expect($this->item->user)->toBeInstanceOf(User::class);
});

test('the number of items in the cart', function () {
    $totalItems = (new CartItem)->numberOfCartItems();

    expect($totalItems)->toBe(2);
});

test('subtotal price of products in the cart', function () {
    $subtotalPrice = (new CartItem)->subtotalPrice();

    expect($subtotalPrice)->toBe(33.30);
});

test('total price of products in the cart', function () {
    $cartItem = new CartItem();
    $coupon = Coupon::factory()->create([
        'value' => 20
    ]);

    $totalPrice = $cartItem->totalPrice($cartItem->subtotalPrice(), $coupon->value);

    expect($totalPrice)->toBe($cartItem->subtotalPrice() - $coupon->value);
});
