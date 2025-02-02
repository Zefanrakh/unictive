<?php

namespace App\Http\Requests\User;

use App\Enums\UserRole;
use App\Http\Requests\RegisterRequest;

class CreateUserRequest extends RegisterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'role' => ['required', 'in:' . implode(',', array_column(UserRole::cases(), 'value'))],
            'password' => 'required|string|min:6',
        ]);
    }
}
