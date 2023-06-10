<?php

namespace App\Listeners;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CartUpdatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $couponCode = session()->get('coupon')['code'];

        if($couponCode) {
            $coupon = Coupon::findByCode($couponCode);

            $coupon->increment('times_used', 1);

            session()->put('coupon', [
                'name' => $coupon->name,
                'code' => $coupon->code,
                'type' => $coupon->type,
                'discount' => $coupon->discount($event->cart->subtotalPrice())
            ]);
        }
    }
}
