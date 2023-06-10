<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', Rule::unique('books', 'title')->ignore($this->book)],
            'slug' => [Rule::unique('books', 'slug')->ignore($this->book)],
            'cover' => 'nullable|image',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'in_stock_quantity' => 'required|integer|min:0',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'description' => 'required',
            'price' => 'required|numeric|min:0|max:999',
            'date' => 'required|date_format:Y-m-d|before_or_equal:now',
            'pages' => 'required|numeric',
            'dimensions' => 'required|string|max:255',
            'languages' => 'required|string|max:255',
            'type' => 'required|string|max:255'
        ];
    }
}
