<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Coupon
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $discount
 * @property int $times_used
 * @property \Illuminate\Support\Carbon $valid_from
 * @property \Illuminate\Support\Carbon $valid_until
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'type',
        'value',
        'percent_off',
        'valid_from',
        'valid_until'
    ];

    protected $casts = [
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
    ];

    public function discount($total)
    {
        if($this->type === 'fixed') {
            return $this->value;
        }

        if($this->type === 'percent_off') {
            return number_format(($this->percent_off / 100) * $total, 2);
        }

        return 0;
    }

    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

}
