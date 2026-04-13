<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Role\RoleResource;
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
            'relationships' => $this->getRelationships(),
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
            'created_at' => !is_null($this->created_at) ? $this->created_at->diffForHumans() : null,
            'updated_at' => !is_null($this->updated_at) ? $this->updated_at->diffForHumans() : null,
        ];
    }

    /**
     * 
     */
    private function getRelationships(): array
    {
        return [
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
        ];
    }
}
