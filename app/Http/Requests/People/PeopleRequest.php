<?php

namespace App\Http\Requests\People;

use Illuminate\Foundation\Http\FormRequest;

class PeopleRequest extends FormRequest
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
            'name' => 'required|max:32|min:2|string|unique:App\Models\People,name',
            'birth' => 'date',
            'gender' => 'string',
            'photo' => 'image',
            'background_photo' => 'image',
            'about' => 'string|max:300|min:20',
            'twitter' => 'string',
            'facebook' => 'string',
            'instagram' => 'string',
            'anilist' => 'string',
            'myanimelist' => 'string',
            'youtube' => 'string',
            'website' => 'string'
        ];
    }
}
