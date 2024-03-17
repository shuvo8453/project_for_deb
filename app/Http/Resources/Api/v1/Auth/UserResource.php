<?php

namespace App\Http\Resources\Api\v1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            "employee_id" => $this->employee_id,
            "position" => $this->position,
            'created' => $this->updated_at ? $this->created_at->format('d/m/Y') : null,
            'updated' => $this->updated_at ? $this->updated_at->format('d/m/Y') : null,
        ];
    }
}
