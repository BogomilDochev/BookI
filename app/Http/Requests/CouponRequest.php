<?php

namespace App\Http\Requests;

use App\Models\Coupon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'code' => ['required', 'string', 'max:255',Rule::unique('coupons', 'code')->ignore($this->coupon)],
            'type' => 'required',
            'value' => 'sometimes|min:0',
            'percent_off' => 'sometimes|min:0|max:100',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date',
        ];
    }
}
