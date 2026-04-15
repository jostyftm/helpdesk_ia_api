<?php

namespace App\Models;

use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Model;

class TicketSource extends Model
{

    use HasSearchable;

    protected $fillable = [
        'name',
        'icon',
    ];
}
