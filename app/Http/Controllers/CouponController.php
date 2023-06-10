<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CouponController extends Controller
{
    public function __construct(
        protected CartItem $cart,
        protected Coupon $coupon
    ) {
    }

    public function store(Request $request)
    {
        $coupon = Coupon::findByCode($request->coupon_code);

        if (!$coupon) {
            return back()->with('error', 'Wrong coupon code!');
        }

        if ($coupon->valid_from->greaterThan(Carbon::now()) || $coupon->valid_until->lessThan(Carbon::now())) {
            return back()->with('error', 'The coupon has expired!');
        }

        if($coupon->type === 'fixed') {
            if (($coupon->discount($this->cart->subtotalPrice()) * 2) > $this->cart->subtotalPrice()) {
                return back()->with('error', 'The price of the chosen items is too low for the coupon to be applied!');
            }
        }

        $coupon->increment('times_used', 1);

        session()->put('coupon', [
            'name' => $coupon->name,
            'code' => $coupon->code,
            'type' => $coupon->type,
            'discount' => $coupon->discount($this->cart->subtotalPrice())
        ]);

        return back()->with('success', 'Coupon has been applied!');
    }

    public function destroy()
    {
        session()->forget('coupon');

        return back()->with('success', 'Coupon has been removed!');
    }

}
