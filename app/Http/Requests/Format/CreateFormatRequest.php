<?php

namespace App\Http\Requests\Format;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:32|min:2|string|unique:App\Models\Format,name',
        ];
    }
}
