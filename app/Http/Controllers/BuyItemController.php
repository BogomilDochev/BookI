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
            'favorites' => (new BookController)->numberOfFavorites(),
            'cartItems' => $this->numberOfCartItems(),
            'total' => $this->totalPrice()
        ]);
    }

    public function store(Book $book)
    {
        try {
            //add a book to favorites of the logged in person
            $book->buyitems()->create([
                'user_id' => auth()->id(),
            ]);

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
        BuyItem::query()->delete();

        return back()->with('success', 'Congratulations, you bought the books!');
    }

    //Returns the number of books added to the cart from the authenticated user
    public function numberOfCartItems(): int
    {
        $count = BuyItem::query()->where('user_id','=', auth()->id())->count();

        return ($count);
    }

    //Returns the sum of the price of all products in the cart
    public function totalPrice()
    {
        $price=[];

        if(BuyItem::latest()->where('user_id','=', auth()->id())->exists())
        {
            $allBuyItems = $this->numberOfCartItems();

            $total = BuyItem::latest()->where('user_id','=', auth()->id())->get();

            for($i=0; $i<$allBuyItems; $i++)
            {
                $price[] = $total[$i]->book->price;//
            }
        }

        return array_sum($price);
    }
}
