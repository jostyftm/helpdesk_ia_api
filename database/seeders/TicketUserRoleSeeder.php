<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketUserRoleSeeder extends Seeder
{

    private $ticketRoles = [
        [
            'name' => 'requester',
            'display_name' => 'Solicitante',
        ],
        [
            'name' => 'technician_responsible',
            'display_name' => 'Técnico responsable',
        ],
        [
            'name' => 'technician_collaborator',
            'display_name' => 'Técnico colaborador',
        ],
        [
            'name' => 'watcher',
            'display_name' => 'observador',
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->ticketRoles as $role) {
            \App\Models\TicketUserRole::create($role);
        }
    }
}
