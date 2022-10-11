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
            "name" => "required|string|max:32|min:2|unique:App\Models\MangaOverView,name",
            "alternative_name" => "string",
            "photo" => "image",
            "background_photo" => "image",
            "synopsis" => "string|max:500|min:20",
            "categories" => "required|array",
            "staffs" => "required|array",
            "format" => "required|string",
            "status" => "required|string",
        ];
    }
}
