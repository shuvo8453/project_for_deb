<?php

namespace App\Http\Requests\Api\v1\Task;

use App\Enums\TaskStatus;
use Illuminate\Validation\Rule;
use Joy2362\ServiceGenerator\Request\ApiServiceRequest;

class TaskRequest extends ApiServiceRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('sanctum')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:1', 'max:100', 'string'],
            'project_code' => ['required', 'min:1', 'max:100', 'string', 'exists:projects,code'],
            'description' => ['required', 'min:1', 'string'],
            'status' => ['required', Rule::enum(TaskStatus::class)],
            'user_id' => ['nullable', 'array'],
        ];
    }
}
