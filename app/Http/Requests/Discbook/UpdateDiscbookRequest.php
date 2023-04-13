<?php

namespace App\Http\Requests\Discbook;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscbookRequest extends FormRequest
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
            'discount_id' =>'exists:discounts,id',
            'book_id' =>'exists:books,id',
        ];
    }
}
