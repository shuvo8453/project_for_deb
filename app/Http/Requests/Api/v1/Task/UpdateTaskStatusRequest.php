<?php

namespace App\Http\Requests\Api\v1\Task;

use App\Enums\TaskStatus;
use Illuminate\Validation\Rule;
use Joy2362\ServiceGenerator\Request\ApiServiceRequest;

class UpdateTaskStatusRequest extends ApiServiceRequest
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
            'status' => ['required', Rule::enum(TaskStatus::class)]
        ];
    }
}
