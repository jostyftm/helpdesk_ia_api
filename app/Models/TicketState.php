<?php

namespace App\Models;

use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Model;

class TicketState extends Model
{

    use HasSearchable;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'display_name',
        'pause_sla',
        'text_color',
        'bg_color',
    ];

    /**
     * The attributes that should be cast to native types.
     * 
     * @return array<string, string>
     */
    public function casts(): array
    {
        return [
            'pause_sla' => 'boolean',
        ];
    }
}
