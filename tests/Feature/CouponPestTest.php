<?php

use App\Models\Book;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

test('admin can access all coupons page', function () {
    actingAs(User::factory()->create([
        'is_admin' => true
    ]));

    get(route('admin.coupons'))->assertStatus(200);
});

test('admin can access add coupon page', function () {
    actingAs(User::factory()->create([
        'is_admin' => true
    ]));

    get(route('coupons.create'))->assertStatus(200);
});

test('admin can access edit coupon page', function () {
    $coupon = Coupon::factory()->create();
    $user = User::factory()->create();
    $admin = User::factory()->create([
        'is_admin' => true
    ]);


    actingAs($admin)
        ->get(route('coupons.edit', $coupon->id))
        ->assertStatus(200);

    actingAs($user)
        ->get(route('coupons.edit', $coupon->id))
        ->assertStatus(403);
});

test('create coupon successfully', function () {
    actingAs(User::factory()->create([
        'is_admin' => true
    ]));

    $coupon = [
        'name' => 'Christmas coupon',
        'code' => 'CHRISTMAS-COUPON-2023',
        'type' => 'percent_off',
        'percent_off' => 30,
        'valid_from' => now()->subDays(3),
        'valid_until' => now()->addDays(3),
        'updated_at' => now(),
        'created_at' => now()
    ];

    post(route('coupons.store'), $coupon)
        ->assertStatus(302)
        ->assertRedirect(route('admin.coupons'));

    assertDatabaseHas('coupons', $coupon);

    $lastCoupon = Coupon::latest()->first();

    expect($lastCoupon->name)->toBe($coupon['name']);
    expect($lastCoupon->code)->toBe($coupon['code']);
});

test('update coupon successfully', function () {
    actingAs(User::factory()->create([
        'is_admin' => true
    ]));

    $coupon = Coupon::factory()->create();

    assertDatabaseHas('coupons', ['name' => $coupon->name]);

    patch(route('coupons.update', $coupon->id), [
        'name' => 'New name',
        'code' => 'New code',
        'type' => 'percent_off',
        'percent_off' => 30,
        'valid_from' => now()->subDays(3),
        'valid_until' => now()->addDays(3),
        'updated_at' => now(),
        'created_at' => now()
    ])->assertStatus(302)
      ->assertRedirect(route('admin.coupons'));

    assertDatabaseHas('coupons', ['name' => 'New name']);
});

test('delete coupon', function () {
    actingAs(User::factory()->create([
        'is_admin' => true
    ]));

    $coupon = Coupon::factory()->create();

    assertDatabaseHas('coupons', ['name' => $coupon->name]);

    delete(route('coupons.delete', $coupon->id))
        ->assertStatus(302)
        ->assertRedirect(session()->previousUrl());

    assertDatabaseMissing('coupons', ['name' => $coupon->name]);
});

test('apply coupon successfully', function () {
    actingAs($user = User::factory()->create());
    $book = Book::factory()->create([
        'price' => 20
    ]);
    $coupon = Coupon::factory()->create([
        'value' => 5
    ]);
    $cartItems = CartItem::factory()->create([
        'user_id' => $user->id,
        'book_id' => $book->id
    ]);

    post(route('coupon.store'), [
        'coupon_code' => $coupon->code
    ])->assertSessionHas('success', 'Coupon has been applied!');
});

test('remove coupon from session', function () {
    actingAs(User::factory()->create());
    $coupon = Coupon::factory()->create([
        'value' => 5
    ]);

    session()->put('coupon', [
        'name' => $coupon->name,
        'discount' => $coupon->discount(20)
    ]);

    get(route('cart'))->assertSessionHas('coupon');

    delete(route('coupon.delete'))->assertSessionMissing('coupon');
});

test('coupon cannot be applied when the price is too low', function () {
    actingAs($user = User::factory()->create());
    $book = Book::factory()->create([
        'price' => 4
    ]);
    $cartItem = CartItem::factory()->create([
        'book_id' => $book->id,
        'user_id' => $user->id
    ]);
    $coupon = Coupon::factory()->create([
        'value' => 20
    ]);

    post(route('coupon.store'), [
        'coupon_code' => $coupon->code
    ])->assertSessionHas('error', 'The price of the chosen items is too low for the coupon to be applied!');
});

test('wrong code inserted', function () {
    actingAs($user = User::factory()->create());
    $book = Book::factory()->create([
        'price' => 4
    ]);
    $cartItem = CartItem::factory()->create([
        'book_id' => $book->id,
        'user_id' => $user->id
    ]);

    post(route('coupon.store'), [
        'coupon_code' => 'Wrong-Coupon-Code'
    ])->assertSessionHas('error', 'Wrong coupon code!');
});

test('expired code inserted', function () {
    actingAs($user = User::factory()->create());
    $book = Book::factory()->create([
        'price' => 4
    ]);
    $cartItem = CartItem::factory()->create([
        'book_id' => $book->id,
        'user_id' => $user->id
    ]);
    $coupon = Coupon::factory()->create([
        'valid_from' => now()->subDays(5),
        'valid_until' => now()->subDays(3)
    ]);

    post(route('coupon.store'), [
        'coupon_code' => $coupon->code
    ])->assertSessionHas('error', 'The coupon has expired!');
});
