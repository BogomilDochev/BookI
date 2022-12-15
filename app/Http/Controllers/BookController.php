<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index() {

        $currentSort = $this->currentSorting();


        return view('books.index', [
            'books' => Book::sortable()->filter(
                request(['category'])
            )->paginate(16)->withQueryString(),
            'categories' => Category::all(),
            'currentSort' => $currentSort
        ]);
    }

    public function show(Book $book) {
        return view('books.show', [
           'book' => $book
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

            if (array_key_exists('sort', $params) && array_key_exists('sort', $params)) {
                if ($params['sort'] == 'price' && $params['direction'] == 'asc') {
                    $sort = 'Lowest price';
                }

                if ($params['sort'] == 'price' && $params['direction'] == 'desc') {
                    $sort = 'Highest price';
                }

                if ($params['sort'] == 'created_at' && $params['direction'] == 'asc') {
                    $sort = 'Newest';
                }

                if ($params['sort'] == 'created_at' && $params['direction'] == 'desc') {
                    $sort = 'Oldest';
                }
            }

        }
        return ($sort);
    }
}
