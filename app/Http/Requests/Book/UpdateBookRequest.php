<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'categories_id'=>'exists:categories,id',
            'name'=>'string',
            'author_id'=>'exists:authors,id',
            'title'=>'string',
            'price'=>'integer',
            'image'=>'nullable|mimes:jpeg,jpg,png,gif,webp'
        ];
    }
}
