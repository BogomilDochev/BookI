<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Termwind\Components\Ol;

/**
 * App\Models\Book
 *
 * @property
 * @property int $id
 * @property int|null $category_id
 * @property string $author
 * @property string $publisher
 * @property string $slug
 * @property string $title
 * @property string|null $cover
 * @property string $description
 * @property string $price
 * @property int $in_stock_quantity
 * @property string $date
 * @property int $pages
 * @property string $dimensions
 * @property string $languages
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $cartAddedBy
 * @property-read int|null $cart_added_by_count
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comment
 * @property-read int|null $comment_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $favoritedBy
 * @property-read int|null $favorited_by_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OldSlug> $oldSlugs
 * @property-read int|null $old_slugs_count
 */

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'old_slug' => 'array'
    ];

    public $sortable = ['title', 'price', 'created_at'];

    //Resolves the N+1 query problem
    protected $with = ['category'];

    public function scopeFilter($query, array $filters) //Book::newQuery->filter()
    {
        //search functionality for a title, description and author
        $query->when($filters['search'] ?? false,
            fn($query, $search) =>
                $query->where(fn($query) =>
                    $query->where('title', 'like', '%'.request('search').'%')
                            ->orWhere('author', 'like', '%'.request('search').'%')

            )
        );

        $query->when($filters['category'] ?? false,
            fn($query, $category) =>
                $query->whereHas('category', fn($query) =>
                    $query->where('slug', $category)
            )
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(
            User::class,
            'favorite_books',
            'book_id',
            'user_id'
        );
    }

    public function cartAddedBy()
    {
        return $this->belongsToMany(
            User::class,
            'cart_items',
            'book_id',
            'user_id'
        );
    }

    public function oldSlugs()
    {
        return $this->hasmany(OldSlug::class);
    }

    public function currentSorting(): string
    {
        $sort = 'Sort by:';

        if ($UrlParameters = $this->getUrlParameters()) {
            $sort .= $this->getSortTitle($UrlParameters['sort'], $UrlParameters['direction']);
        }

        return ($sort);
    }

    protected function getUrlParameters()
    {
        $actual_link = url()->full();
        $url_components = parse_url($actual_link);

        if (array_key_exists('query', $url_components)) {
            parse_str($url_components['query'], $params);

            if (
                array_key_exists('sort', $params) &&
                array_key_exists('direction', $params)
            ) {
                return $params;
            }
        }

        return [];
    }

    protected function getSortTitle($sort, $direction): string
    {
        if ($sort === 'price' && $direction === 'asc') {
            return ' Lowest price';
        }

        if ($sort === 'price' && $direction === 'desc') {
            return ' Highest price';
        }

        if ($sort === 'created_at' && $direction === 'desc') {
            return ' Newest';
        }

        if ($sort === 'created_at' && $direction === 'asc') {
            return ' Oldest';
        }

        return '';
    }

    public function sorting(Book $book)
    {
        return $this->applyOrderByToBooks($book)
                    ->filter(request(['search', 'category']))
                    ->paginate(16)
                    ->withQueryString();
    }

    protected function applyOrderByToBooks(Book $book)
    {
        $urlParameters = $this->getUrlParameters();
        $sortParameter = $urlParameters['sort'] ?? '';
        $directionParameter = $urlParameters['direction'] ?? '';

        if ($sortParameter === 'price' && $directionParameter === 'asc') {
            return $book->orderBy('price', 'ASC');
        }

        if ($sortParameter === 'price' && $directionParameter === 'desc') {
            return $book->orderBy('price', 'DESC');
        }

        if ($sortParameter === 'created_at' && $directionParameter === 'asc') {
            return $book->orderBy('created_at', 'ASC');
        }

        return $book->orderBy('created_at', 'DESC');
    }

    //Create old slug which is the previous slug of the book object
    public function createOldSlug(Book $book): void
    {
        OldSlug::create([
            'slug' => $book->slug,
            'book_id' => $book->id
        ]);
    }
}
