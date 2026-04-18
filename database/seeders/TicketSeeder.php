<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\TicketState;
use App\Models\TicketUserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::factory()->count(50)->create()->each(function (Ticket $ticket) {
            $requester = User::role('cliente')->inRandomOrder()->first();
            $technician = User::role('agente')->inRandomOrder()->first();

            $requesterRole = TicketUserRole::where('name', 'requester')->first();
            $technicianRole = TicketUserRole::where('name', 'technician_responsible')->first();

            $ticketState = TicketState::where('name', 'created')->first();

            $ticket->stateHistories()->attach($ticketState->id, ['is_current' => true]);

            $ticket->ticketUsers()->create([
                'user_id' => $requester->id,
                'ticket_user_role_id' => $requesterRole->id,
            ]);

            $ticket->ticketUsers()->create([
                'user_id' => $technician->id,
                'ticket_user_role_id' => $technicianRole->id,
            ]);
        });
    }
}
