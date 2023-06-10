<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property-read int $id
 * @property string $name
 * @property-read $email
 * @property-read \Carbon\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string $avatar
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $favorites
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $cartItems
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Book::class, 'favorite_books', 'user_id', 'book_id');
    }

    public function cartItems()
    {
        return $this->belongsToMany(Book::class, 'cart_items', 'user_id', 'book_id');
    }
}
