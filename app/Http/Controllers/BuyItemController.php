<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BuyItem;
use Illuminate\Http\Request;

class BuyItemController extends Controller
{
    public function index()
    {
        return view('cart.index', [
            'buyItems' => BuyItem::latest()->where('user_id','=', auth()->id())->filter(
                request(['search']))->paginate(16)->withQueryString(),
            'favorites' => (new Book)->numberOfFavorites(),
            'cartItems' => (new BuyItem)->numberOfCartItems(),
            'total' => (new BuyItem())->totalPrice()
        ]);
    }

    public function store(Book $book)
    {
        try {
            $buyItem = new BuyItem();

            $buyItem->user_id = auth()->id();
            $buyItem->book_id = $book->id;
            $buyItem->productQuantity = request('quantity');

            $buyItem->save();

            return back()->with('success', 'The item was added to the cart');
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('error', 'The item was already added to the cart');
        }

    }

    public function destroy(BuyItem $item)
    {
        $item->delete();

        return back()->with('success', 'Book removed from cart!');
    }

    public function destroyAll()
    {
        $cartItems = BuyItem::all();

        foreach ($cartItems as $cartItem) {
            $cartItem->book->decrement('inStockQuantity', $cartItem->productQuantity);
        }

        BuyItem::query()->delete();

        return back()->with('success', 'Congratulations, you bought the books!');
    }

    public function increaseQuantity(BuyItem $buyItem)
    {
        try {
            $buyItem->increment('productQuantity', 1);

            return back();
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with('error', 'You cannot buy more than 5 books');
        }
    }

    public function decreaseQuantity(BuyItem $buyItem)
    {
        try {
            $buyItem->decrement('productQuantity', 1);

            return back();
        } catch (\Illuminate\Database\QueryException $e) {
            $buyItem->delete();

            return redirect('/cart')->with('success', 'Book removed from cart!');
        }
    }

}
