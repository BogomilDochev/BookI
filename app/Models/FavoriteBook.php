<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FavoriteBook
 *
 * @property int $id
 * @property int|null $book_id
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book|null $book
 * @property-read \App\Models\User|null $user
 */
class FavoriteBook extends Model
{
    use HasFactory;

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Returns the number of books added to favorites from the authenticated user
    public function numberOfFavorites(): int
    {
        $count = auth()->user()?->favorites->count() ?? 0;

        return ($count);
    }
}
