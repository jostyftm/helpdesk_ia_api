<?php

namespace App\Http\Resources\TicketSource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketSourceResource extends JsonResource
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
            'type' => 'ticket_source',
            'attributes' => $this->getAttributes(),
            'relationships' => $this->getRelationships(),
        ];
    }

    private function getAttributes(): array
    {
        return [
            'name' => $this->name,
            'icon' => $this->icon,
        ];
    }

    private function getRelationships(): array
    {
        return [];
    }
}
