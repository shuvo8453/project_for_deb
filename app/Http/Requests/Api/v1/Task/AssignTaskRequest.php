<?php

namespace App\Http\Requests\Api\v1\Task;

use Joy2362\ServiceGenerator\Request\ApiServiceRequest;

class AssignTaskRequest extends ApiServiceRequest
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
            'user_id' => ['required', 'array'],
        ];
    }
}
