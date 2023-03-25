<?php

namespace App\Http\Requests\Audio;

use Illuminate\Foundation\Http\FormRequest;

class StoreAudioRequest extends FormRequest
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
            'name'=>'required|string',
            'book_id'=>'required|exists:books,id',
            'dubauthor_id'=>'required|exists:dubauthors,id',
            'audio'=>'required|mimes:ogg,mp3,wav'
        ];
    }
}
