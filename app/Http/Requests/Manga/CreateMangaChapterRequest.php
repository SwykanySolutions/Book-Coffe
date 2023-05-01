<?php

namespace App\Http\Requests\Manga;

use Illuminate\Foundation\Http\FormRequest;

class CreateMangaChapterRequest extends FormRequest
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
            "title" => "string",
            "chapter" => "required|numeric",
            "pages" => "required|array|max:500",
            "pages.*" => "image|mimes:jpg,jpeg,png,gif,webp",
            "manga_id" => "required|numeric",
        ];
    }
}