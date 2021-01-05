<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class AuthRequest extends FormRequest
{

    const LOGIN_ROUTE_NAME = 'login';

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
        if($this->route()->getName() === self::LOGIN_ROUTE_NAME) {
            return [
                'email' => 'required|string|email',
                'password' => 'required|string|min:3|max:191'
            ];
        }
        return [
            'name' => 'required|string|min:3|max:191',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:3|max:191'
        ];
    }

    public function validated() {
        if($this->route()->getName() !== self::LOGIN_ROUTE_NAME) {
            return array_merge($this->validator->validated(), [
                'password' => Hash::make($this->get('password'))
            ]);
        }

        return $this->validator->validated();
    }
}
