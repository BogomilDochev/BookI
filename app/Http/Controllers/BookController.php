<?php

namespace App\Http\Controllers;

use App\Http\Middleware\RedirectIfOldSlug;
use App\Models\Book;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\FavoriteBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function __construct(
        protected Book $book,
        protected FavoriteBook $favorites,
        protected CartItem $cart
    ) {
        $this->middleware(RedirectIfOldSlug::class)->only('show');
    }

    public function index()
    {
        $currentSort = $this->book->currentSorting();

        return view('books.index', [
            'books' => $this->book->sorting($this->book),
            'categories' => Category::all(),
            'currentSort' => $currentSort,
            'favorites' => $this->favorites->numberOfFavorites(),
            'numberOfCartItems' => $this->cart->numberOfCartItems()
        ]);
    }

    public function show(Request $request)
    {
        $slug = $request->route('slug');

        $book = Book::query()->where('slug', $slug)->first();

        if ($book->in_stock_quantity == 0) {
            $quantityLabel = 'In Stock: Not available';
        } else {
            $quantityLabel = 'In Stock: '.$book->in_stock_quantity;
        }

        return view('books.show', [
            'book' => $book,
            'favorites' => $this->favorites->numberOfFavorites(),
            'numberOfCartItems' => $this->cart->numberOfCartItems(),
            'quantityLabel' => $quantityLabel
        ]);
    }


}
