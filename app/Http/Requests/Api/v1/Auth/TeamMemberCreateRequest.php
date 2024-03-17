<?php

namespace App\Http\Requests\Api\v1\Auth;

use Joy2362\ServiceGenerator\Request\ApiServiceRequest;

class TeamMemberCreateRequest extends ApiServiceRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'min:1', 'max:100', 'email', 'unique:users'],
            'name' => ['required', 'min:1', 'max:100', 'string'],
            'password' => ['required', 'min:4', 'max:100'],
            'employee_id' => ['required', 'min:1', 'max:100', 'unique:users'],
            'position' => ['required', 'min:1', 'max:100', 'not_in:manager'],
        ];
    }
}
