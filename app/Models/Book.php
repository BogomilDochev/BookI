<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    use HasFactory, Sortable;

    protected $guarded = [];

    public $sortable = ['title', 'price', 'created_at'];

    //Resolves the N+1 query problem
    protected $with = ['category'];

    public function scopeFilter($query, array $filters) //Book::newQuery->filter()
    {
        //search functionality for a title, description and author
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('title', 'like', '%' . request('search') . '%')
                      ->orWhere('author', 'like', '%' . request('search') . '%')

            )
        );

        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn ($query) =>
                $query->where('slug', $category)
            )
        );
    }

    //Returns the number of books added to favorites from the authenticated user
    public function numberOfFavorites(): int
    {
        $count = Favorite::query()->where('user_id','=', auth()->id())->count();

        return ($count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function buyItems()
    {
        return $this->hasMany(BuyItem::class);
    }
}
