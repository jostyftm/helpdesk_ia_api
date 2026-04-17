<?php

namespace App\Http\Resources\TicketState;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketStateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'ticket-states',
            'id' => $this->id,
            'attributes' => $this->getAttributes(),
            'relationships' => $this->getRelationships(),
        ];
    }

    private function getAttributes(): array
    {
        return [
            'name'          => $this->name,
            'display_name' => $this->display_name,
            'pause_sla'    => $this->pause_sla,
            'text_color'   => $this->text_color,
            'bg_color'     => $this->bg_color,
            'created_at' => !is_null($this->created_at) ? $this->created_at->diffForHumans() : null,
            'updated_at' => !is_null($this->updated_at) ? $this->updated_at->diffForHumans() : null,
        ];
    }

    private function getRelationships(): array
    {
        return [
            // Define relationships here if needed
        ];
    }
}
