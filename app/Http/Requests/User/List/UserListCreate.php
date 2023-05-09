<?php

namespace App\Http\Requests\User\List;

use Illuminate\Foundation\Http\FormRequest;

class UserListCreate extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "number" => "required|numeric",
            "id" => "required|integer",
        ];
    }
}