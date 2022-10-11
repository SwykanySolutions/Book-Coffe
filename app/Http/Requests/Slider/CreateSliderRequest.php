<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class CreateSliderRequest extends FormRequest
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
            'background_photo' => 'required|image|mimes:jpg,jpeg,png,gif',
            'title_photo' => 'required|image|mimes:png',
            'manga_over_view_id' => 'required|numeric',
        ];
    }
}
