<?php

namespace App\Http\Requests\Manga\Score;

use Illuminate\Foundation\Http\FormRequest;

class CreateMangaScoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        return $user;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "manga_id" => "required|numeric",
            "score" => "required|integer|between:1,10",
        ];
    }
}
