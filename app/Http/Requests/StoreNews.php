<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNews extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:15|max:120',
            'preview_text' => 'required|min:30|max:45',
            'description' => 'required|min:120|max:500',
            'image' => 'required|image',
            'category' => 'required'
        ];
    }
}
