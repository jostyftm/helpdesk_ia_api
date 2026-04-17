<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\Pivot;

#[Table(incrementing: true, timestamps: true)]
class TicketStateHistory extends Pivot
{
    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_id',
        'ticket_state_id',
        'is_current',
    ];

    /**
     * The attributes that should be cast to native types.
     * 
     * @return array<string, string>
     */
    public function casts(): array
    {
        return [
            'is_current' => 'boolean',
        ];
    }
}
