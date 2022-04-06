<?php

namespace App\Http\Requests\Manga;

use Illuminate\Foundation\Http\FormRequest;

class CreateMangaOverViewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        return $user->create_manga || $user->owner;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|string|max:32|min:2|unique:App\Models\MangaOverView,name",
            "photo" => "image",
            "background_photo" => "image",
            "synopsis" => "string|max:300|min:20",
            "categories" => "required|array",
            "staffs" => "required|array",
            "format" => "required|string",
            "status" => "required|string"
        ];
    }
}
