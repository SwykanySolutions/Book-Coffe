<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PermissionUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        return $user->create_people || $user->owner;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => 'boolean',
            'report_message' => 'boolean',
            'report_chapter' => 'boolean',
            'create_manga' => 'boolean',
            'update_manga' => 'boolean',
            'delete_manga' => 'boolean',
            'upload_manga_chapter' => 'boolean',
            'update_manga_chapter' => 'boolean',
            'delete_manga_chapter' => 'boolean',
            'create_novel' => 'boolean',
            'update_novel' => 'boolean',
            'delete_novel' => 'boolean',
            'upload_novel_chapter' => 'boolean',
            'update_novel_chapter' => 'boolean',
            'delete_novel_chapter' => 'boolean',
            'create_people' => 'boolean',
            'update_people' => 'boolean',
            'delete_people' => 'boolean',
            'ban_user' => 'boolean',
            'unban_user' => 'boolean'
        ];
    }
}
