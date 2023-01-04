<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

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

    //Returns the number of books added to the cart from the authenticated user
    public function numberOfCartItems(): int
    {
        $count = BuyItem::query()->where('user_id','=', auth()->id())->count();

        return ($count);
    }

    //Returns the sum of the price of all products in the cart
    public function totalPrice()
    {
        $price=[];

        if(BuyItem::latest()->where('user_id','=', auth()->id())->exists())
        {
            $allBuyItems = $this->numberOfCartItems();

            $total = BuyItem::latest()->where('user_id','=', auth()->id())->get();

            for($i=0; $i<$allBuyItems; $i++)
            {
                $price[] = $total[$i]->book->price;//
            }
        }

        return array_sum($price);
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
