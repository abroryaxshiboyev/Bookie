<?php

namespace App\Http\Requests\Audio;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAudioRequest extends FormRequest
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
            'name'=>'string',
            'book_id'=>'exists:books,id',
            'dubauthor_id'=>'exists:dubauthors,id',
            'audio'=>'mimes:audio',
        ];
    }
}
