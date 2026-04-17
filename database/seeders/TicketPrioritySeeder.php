<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketPrioritySeeder extends Seeder
{
    private $priorities = [
        [
            'name'          => 'low',
            'display_name'  => 'Baja',
            'weight'        => 1,
            'text_color'    => '#ffffff',
            'bg_color'      => '#28a745',
        ],
        [
            'name'          => 'medium',
            'display_name'  => 'Media',
            'weight'        => 2,
            'text_color'    => '#ffffff',
            'bg_color'      => '#ffc107',
        ],
        [
            'name'          => 'high',
            'display_name'  => 'Alta',
            'weight'        => 3,
            'text_color'    => '#ffffff',
            'bg_color'      => '#dc3545',
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->priorities as $priority) {
            \App\Models\TicketPriority::create($priority);
        }
    }
}
