<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->route('user'),
            'address' => 'required',
            'dob' => 'required|date'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
