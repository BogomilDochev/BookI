<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    //search functionality for a title, pages and price
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->whereHas('book', fn($query) =>
                $query->where('title', 'like', '%' . request('search') . '%')
                      ->orWhere('pages', 'like', '%' . request('search') . '%')
                      ->orWhere('price', 'like', '%' . request('search') . '%')

            )
        );
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
