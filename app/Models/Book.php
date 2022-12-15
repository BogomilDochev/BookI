<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Book extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['title', 'price', 'created_at'];

//    public function priceSortable($query)
//    {
//        return $query->join('user_details', 'users.id', '=', 'user_details.user_id')
//            ->orderBy('price', '-')
//            ->select('books.*');
//    }

    public function scopeFilter($query, array $filters) //Post::newQuery->filter()
    {
        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn ($query) =>
                $query->where('slug', $category)
            )
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
