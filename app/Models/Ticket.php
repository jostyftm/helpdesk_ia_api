<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Database\Factories\TicketFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    /** 
     * @use HasFactory<TicketFactory> 
     */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'subject',
        'description',
        'ticket_source_id',
        'ticket_category_id',
        'ticket_priority_id',
    ];

    /**
     * Get the state history of the ticket.
     * 
     * @return BelongsToMany
     */
    public function stateHistories(): BelongsToMany
    {
        return $this->belongsToMany(TicketState::class, 'ticket_state_histories')
            ->withPivot('is_current')
            ->withTimestamps();
    }

    /**
     * Get the current state of the ticket.
     * 
     * @return TicketState
     */
    public function currentState(): ?TicketState
    {
        return $this->stateHistories()->wherePivot('is_current', true)->first();
    }

    /**
     * Get the source of the ticket.
     * 
     * @return BelongsTo
     */
    public function source(): BelongsTo
    {
        return $this->belongsTo(TicketSource::class);
    }

    /**
     * Get the category of the ticket.
     * 
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(TicketCategory::class);
    }

    /**
     * Get the priority of the ticket.
     * 
     * @return BelongsTo
     */
    public function priority(): BelongsTo
    {
        return $this->belongsTo(TicketPriority::class);
    }

    /**
     * Get the users associated with the ticket.
     * 
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(TicketUser::class);
    }
}
