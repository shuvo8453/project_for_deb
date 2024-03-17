<?php

namespace App\Http\Requests\Api\v1\Project;

use Joy2362\ServiceGenerator\Request\ApiServiceRequest;

class ProjectRequest extends ApiServiceRequest
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
            'name' => ['required', 'min:1', 'max:100', 'string', 'unique:projects'],
            'code' => ['required', 'min:1', 'max:100', 'string', 'unique:projects'],
        ];
    }
}
