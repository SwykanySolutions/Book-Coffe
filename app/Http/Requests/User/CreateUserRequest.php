<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|max:32|min:2|string|unique:App\Models\User,name|alpha_dash',
            'email' => 'required|email:rfc,dns|string|unique:App\Models\User,email',
            'password' => 'required|string|max:32|min:8|regex:/^\S*$/u'
        ];
    }
}
