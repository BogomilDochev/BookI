<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CartItem
 *
 * @property int $id
 * @property int|null $book_id
 * @property int|null $user_id
 * @property int $product_quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book|null $book
 * @property-read \App\Models\User|null $user
 */
class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_quantity'];

    //Returns the number of books added to the cart from the authenticated user
    public function numberOfCartItems(): int
    {
        $count = auth()->user()?->cartItems->count() ?? 0;

        return ($count);
    }

    //Returns the sum of the price of all products in the cart
    public function subtotalPrice(): float
    {
        $subtotal = 0;

        $cartItems = CartItem::latest()->where('user_id', '=', auth()->id())->get();

        if ($cartItems) {
            foreach ($cartItems as $cartItem) {
                $subtotal += $cartItem->book->price * $cartItem->product_quantity;
            }
        }

        return number_format($subtotal, 2);
    }

    public function totalPrice($subtotal, $discount): float
    {
        return $subtotal - $discount;
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
