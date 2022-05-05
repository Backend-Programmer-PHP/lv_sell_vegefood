<?php

namespace App\Modules\Site\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'photo' => 'nullable',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'remember_token' => '',
        ];
    }
}
