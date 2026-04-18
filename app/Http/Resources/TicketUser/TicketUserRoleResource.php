<?php

namespace App\Http\Resources\TicketUser;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketUserRoleResource extends JsonResource
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
            'type' => 'ticket_user_role',
            'attributes' => $this->getAttributes(),
            'relationships' => [],
        ];
    }

    /**
     * The resource's attributes.
     */
    public function getAttributes(): array
    {
        return [
            'name' => $this->name,
            'display_name' => $this->display_name,
            'created_at' => !is_null($this->created_at) ? $this->created_at->diffForHumans() : null,
            'updated_at' => !is_null($this->updated_at) ? $this->updated_at->diffForHumans() : null,
        ];
    }
}
