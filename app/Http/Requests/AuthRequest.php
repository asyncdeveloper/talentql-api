<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class AuthRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:191',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:3|max:191'
        ];
    }

    public function validated() {
        return array_merge($this->validator->validated(), [
            'password' => Hash::make($this->get('password'))
        ]);
    }
}
