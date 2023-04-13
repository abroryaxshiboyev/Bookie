<?php

namespace App\Http\Requests\Discbook;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscbookRequest extends FormRequest
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
            'discount_id' =>'required|exists:discounts,id',
            'book_id' =>'required|exists:books,id',
        ];
    }
}
