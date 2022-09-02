<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        return $user->update_slider || $user->owner;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'background_photo' => 'image|mimes:jpg,jpeg,png,gif',
            'title_photo' => 'image|mimes:png',
            'manga_over_view_id' => 'numeric',
        ];
    }
}
