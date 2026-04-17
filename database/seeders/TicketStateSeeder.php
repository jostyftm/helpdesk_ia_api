<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketStateSeeder extends Seeder
{
    protected $states = [
        [
            'name'          => 'created',
            'display_name'  => 'Nuevo',
            'pause_sla'     => false,
            'text_color'    => '#ffffff',
            'bg_color'      => '#6c757d',
        ],
        [
            'name'          => 'opened',
            'display_name'  => 'Revisado',
            'pause_sla'     => false,
            'text_color'    => '#000000',
            'bg_color'      => '#ffffff',
        ],
        [
            'name'          => 'assigned',
            'display_name'  => 'Asignado',
            'pause_sla'     => false,
            'text_color'    => '#ffffff',
            'bg_color'      => '#007bff',
        ],
        [
            'name'          => 'on_hold',
            'display_name'  => 'En Espera (Tecnico)',
            'pause_sla'     => true,
            'text_color'    => '#ffffff',
            'bg_color'      => '#ffc107',
        ],
        [
            'name'          => 'on_hold',
            'display_name'  => 'En Espera (Proveedor)',
            'pause_sla'     => true,
            'text_color'    => '#ffffff',
            'bg_color'      => '#fd7e14',
        ],
        [
            'name'          => 'resolved',
            'display_name'  => 'Resuelto',
            'pause_sla'     => true,
            'text_color'    => '#ffffff',
            'bg_color'      => '#17a2b8',
        ],
        [
            'name'          => 'closed',
            'display_name'  => 'Cerrado',
            'pause_sla'     => true,
            'text_color'    => '#ffffff',
            'bg_color'      => '#28a745',
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->states as $state) {
            \App\Models\TicketState::create($state);
        }
    }
}
