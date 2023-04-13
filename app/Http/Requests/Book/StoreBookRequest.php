<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'categories_id'=>'required|exists:categories,id',
            'name'=>'required|string|unique:books,name',
            'author_name'=>'required|string',
            'title'=>'required|string',
            'price'=>'required|string',
            'image'=>'nullable|mimes:jpeg,jpg,png,gif,webp'
        ];
    }
}
