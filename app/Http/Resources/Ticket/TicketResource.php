<?php

namespace App\Http\Resources\Ticket;

use App\Http\Resources\TicketCategory\TicketCategoryResource;
use App\Http\Resources\TicketPriority\TicketPriorityResource;
use App\Http\Resources\TicketSource\TicketSourceResource;
use App\Http\Resources\TicketState\TicketStateResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TicketUser\TicketUserResource;
use App\Http\Resources\Ticket\TicketResolutionResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'type' => 'ticket',
            'attributes' => $this->getAttributes(),
            'relationships' => $this->getRelationships(),
        ];
    }

    /**
     * Get the attributes for the resource.
     *
     * @return array<string, mixed>
     */
    private function getAttributes(): array
    {
        return [
            'subject' => $this->subject,
            'description' => $this->description,
            'ticket_source_id' => $this->ticket_source_id,
            'ticket_priority_id' => $this->ticket_priority_id,
            'ticket_category_id' => $this->ticket_category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Get the relationships for the resource.
     * 
     * @return array<string, mixed>
     */
    private function getRelationships(): array
    {
        return [
            'priority' => new TicketPriorityResource($this->whenLoaded('ticketPriority')),
            'category' => new TicketCategoryResource($this->whenLoaded('ticketCategory')),
            'source' => new TicketSourceResource($this->whenLoaded('ticketSource')),
            'ticket_users' => TicketUserResource::collection($this->whenLoaded('ticketUsers')),
            'current_state' => new TicketStateResource(
                $this->whenLoaded('currentState')?->first()
            ),

            // 'state_histories' => TicketStateResource::collection($this->whenLoaded('stateHistories')),
            'technician_responsible' => new UserResource(
                $this->whenLoaded('technicianResponsible')?->first()?->user
            ),
            'resolutions' => TicketResolutionResource::collection($this->whenLoaded('ticketResolutions')),
        ];
    }
}
