<?php

namespace App\Models;

use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Model;

class TicketUserRole extends Model
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
    ];
}
