<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSourceSeeder extends Seeder
{
    /**
     * The ticket sources to seed into the database.
     * 
     * @var array
     */
    protected array $sources = [
        [
            'name' => 'Email',
            'icon' => 'Mail'
        ],
        [
            'name' => 'Chat',
            'icon' => 'MessageSquare'
        ],
        [
            'name' => 'Web',
            'icon' => 'Globe'
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->sources as $source) {
            \App\Models\TicketSource::create($source);
        }
    }
}
