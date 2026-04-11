<?php

namespace App\Http\Resources\User;

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
            'type' => 'users',
            'attributes' => $this->getAttributes(),
        ];
    }

    /**
     * 
     */
    private function getAttributes(): array
    {
        return [
            'name'      => $this->name,
            'last_name' => $this->last_name,
            'email'     => $this->email,
            'is_active' => $this->is_active,
        ];
    }
}
