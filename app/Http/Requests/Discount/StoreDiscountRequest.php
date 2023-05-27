<?php

namespace App\Http\Requests\Discount;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountRequest extends FormRequest
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
            'name'=>'required|string|max:255|unique:discounts,name',
            'amount'=>'required|integer|min:1|max:100',
            'image'=>'nullable|mimes:jpeg,jpg,png,gif,webp',
            'starts'=>'required|date',
            'finishes'=>'required|date'
        ];
    }
}
