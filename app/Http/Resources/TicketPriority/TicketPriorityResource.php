<?php

namespace App\Http\Resources\TicketPriority;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketPriorityResource extends JsonResource
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
            'type' => 'ticket_priority',
            'attributes' => $this->getAttributes(),
            'relationships' => $this->getRelationships(),
        ];
    }

    private function getAttributes(): array
    {
        return [
            'name' => $this->name,
            'weight' => $this->weight,
            'text_color' => $this->text_color,
            'bg_color' => $this->bg_color,
            'created_at' => !is_null($this->created_at) ? $this->created_at->diffForHumans() : null,
            'updated_at' => !is_null($this->updated_at) ? $this->updated_at->diffForHumans() : null,
        ];
    }

    private function getRelationships(): array
    {
        return [];
    }
}
