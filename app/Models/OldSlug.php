<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OldSlug
 *
 * @property int $id
 * @property string $slug
 * @property int|null $book_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book|null $book
 */
class OldSlug extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
