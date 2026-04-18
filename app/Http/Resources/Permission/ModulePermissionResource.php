<?php

namespace App\Http\Resources\Permission;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModulePermissionResource extends JsonResource
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
            'type' => 'module_permission',
            'attributes' => $this->getAttribute(),
            'relationships' => $this->getRelationships(),
        ];
    }

    /**
     * 
     */
    private function getAttribute(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'icon' => $this->icon,
            'path' => $this->path,
            'order' => $this->order,
            'show_sidebar' => $this->show_sidebar,
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
            'permissions' => PermissionResource::collection($this->permissions),
        ];
    }
}
