<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BuyItem;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{

    public function index() {

        return view('books.index', [
            'books' => Book::sortable()->filter(
                request(['search', 'category'])
            )->paginate(16)->withQueryString(),
            'categories' => Category::all(),
            'currentSort' => $this->currentSorting(),
            'favorites' => (new Book)->numberOfFavorites(),
            'cartItems' => (new BuyItem)->numberOfCartItems()
        ]);
    }

    public function show(Book $book) {

        if(request(['search'])) {
            return redirect('/');
        }

        return view('books.show', [
           'book' => $book,
           'favorites' => (new Book)->numberOfFavorites(),
           'cartItems' => (new BuyItem)->numberOfCartItems()

        ]);
    }

   //Function that returns what is the current type of sorting
    public function currentSorting(): string
    {
        $sort = 'Sort by:';

        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $url_components = parse_url($actual_link);

        if (array_key_exists('query', $url_components)) {
            parse_str($url_components['query'], $params);

            if (array_key_exists('sort', $params) && array_key_exists('direction', $params)) {
                if ($params['sort'] == 'price' && $params['direction'] == 'asc') {
                    $sort = 'Lowest price';
                }

                if ($params['sort'] == 'price' && $params['direction'] == 'desc') {
                    $sort = 'Highest price';
                }

                if ($params['sort'] == 'created_at' && $params['direction'] == 'desc') {
                    $sort = 'Newest';
                }

                if ($params['sort'] == 'created_at' && $params['direction'] == 'asc') {
                    $sort = 'Oldest';
                }
            }

        }
        return ($sort);
    }


}
