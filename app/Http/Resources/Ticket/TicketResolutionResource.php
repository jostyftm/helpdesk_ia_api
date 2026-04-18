<?php

namespace App\Http\Resources\Ticket;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResolutionResource extends JsonResource
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
            'type' => 'ticket_resolution',
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
            'description' => $this->description,
            'resolved_at' => $this->resolved_at,
        ];
    }

    /**
     * 
     */
    private function getRelationships(): array
    {
        return [
            'resolver' => new UserResource($this->whenLoaded('resolver')),
        ];
    }
}
