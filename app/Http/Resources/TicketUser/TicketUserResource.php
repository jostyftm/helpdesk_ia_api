<?php

namespace App\Http\Resources\TicketUser;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketUserResource extends JsonResource
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
            'type' => 'ticket_user',
            'attributes' => $this->getAttributes(),
            'relationships' => $this->getRelationships(),
        ];
    }

    private function getAttributes(): array
    {
        return [
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    private function getRelationships(): array
    {
        return [
            'user' => new UserResource($this->whenLoaded('user')),
            'role'  => new TicketUserRoleResource($this->whenLoaded('role')),
        ];
    }
}
