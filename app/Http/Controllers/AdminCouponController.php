<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Book;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\FavoriteBook;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminCouponController extends Controller
{
    public function __construct(
        protected FavoriteBook $favorites,
        protected CartItem $cart
    ) {
    }

    public function index()
    {
        return view('admin.coupons.index', [
            'coupons' => Coupon::latest()->paginate(16),
            'favorites' => $this->favorites->numberOfFavorites(),
            'numberOfCartItems' => $this->cart->numberOfCartItems()
        ]);
    }

    public function create()
    {
        return view('admin.coupons.create', [
            'favorites' => $this->favorites->numberOfFavorites(),
            'numberOfCartItems' => $this->cart->numberOfCartItems()
        ]);
    }

    public function store(CouponRequest $request)
    {
        $validated = $request->validated();

        Coupon::create($validated);

        return redirect(route('admin.coupons'))->with('success', 'New coupon has been added.');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', [
            'coupon' => $coupon,
            'favorites' => $this->favorites->numberOfFavorites(),
            'numberOfCartItems' => $this->cart->numberOfCartItems()
        ]);
    }

    public function update(CouponRequest $request, Coupon $coupon)
    {
        $validated = $request->validated();

        $coupon->update($validated);

        return redirect(route('admin.coupons'))->with('success', 'Coupon Updated!');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return back()->with('success', 'Coupon Deleted!');
    }

}
