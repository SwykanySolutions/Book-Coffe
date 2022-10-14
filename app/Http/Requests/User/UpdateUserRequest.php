<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'max:32|min:2|string|alpha_dash',
            'tag' => 'min:4|max:4|string|regex:/^[0-9]+$/u',
            'about' => 'max:280|string',
            'profile_photo' => 'image|mimes:jpg,jpeg,png,gif',
            'background_photo' => 'image|mimes:jpg,jpeg,png,gif'
        ];
    }
}
