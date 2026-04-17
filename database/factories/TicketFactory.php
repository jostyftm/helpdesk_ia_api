<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $sources = \App\Models\TicketSource::pluck('id')->toArray();
        $categories = \App\Models\TicketCategory::pluck('id')->toArray();
        $priorities = \App\Models\TicketPriority::pluck('id')->toArray();

        return [
            'subject'       => $this->faker->sentence,
            'description'   => $this->faker->paragraph,
            'ticket_source_id' => $this->faker->randomElement($sources),
            'ticket_category_id' => $this->faker->randomElement($categories),
            'ticket_priority_id' => $this->faker->randomElement($priorities),
        ];
    }
}
