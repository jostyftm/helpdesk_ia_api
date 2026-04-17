<?php

namespace App\Models;

use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketPriority extends Model
{
    /** @use HasFactory<\Database\Factories\TicketPriorityFactory> */
    use HasFactory, HasSearchable;

    /**
     * The attributes that are mass assignable.
     * 
     * @return array<int, string>
     */
    protected $fillable = [
        'name',
        'weight',
        'text_color',
        'bg_color',
    ];
}
