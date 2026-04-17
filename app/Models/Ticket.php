<?php

namespace App\Models;

use App\Traits\HasSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Database\Factories\TicketFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\ValidationException;

class Ticket extends Model
{
    /** 
     * @use HasFactory<TicketFactory> 
     */
    use HasFactory, HasSearchable;

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
            ->using(TicketStateHistory::class)
            ->withPivot('is_current')
            ->withTimestamps();
    }

    /**
     * Get the current state of the ticket.
     * 
     * @return BelongsToMany
     */
    public function currentState(): BelongsToMany
    {
        return $this->belongsToMany(TicketState::class, 'ticket_state_histories')
            ->using(TicketStateHistory::class)
            ->withPivot('is_current')
            ->withTimestamps()
            ->wherePivot('is_current', true);
    }

    /**
     * Get the source of the ticket.
     * 
     * @return BelongsTo
     */
    public function ticketSource(): BelongsTo
    {
        return $this->belongsTo(TicketSource::class);
    }

    /**
     * Get the category of the ticket.
     * 
     * @return BelongsTo
     */
    public function ticketCategory(): BelongsTo
    {
        return $this->belongsTo(TicketCategory::class);
    }

    /**
     * Get the priority of the ticket.
     * 
     * @return BelongsTo
     */
    public function ticketPriority(): BelongsTo
    {
        return $this->belongsTo(TicketPriority::class);
    }

    /**
     * Get the users associated with the ticket.
     * 
     * @return HasMany
     */
    public function ticketUsers(): HasMany
    {
        return $this->hasMany(TicketUser::class);
    }

    /**
     * Get the technician responsible for the ticket.
     * 
     * @return HasMany
     */
    public function technicianResponsible(): HasMany
    {
        return $this->hasMany(TicketUser::class)->where('ticket_user_role_id', 2);
    }

    /**
     * Scope a query to filter tickets by their current state.
     * 
     * @param  Builder  $query
     * @param  int  $stateId
     * @return Builder
     */
    public function scopeFilterByState($query, $stateId): Builder
    {
        return $query->whereHas('stateHistories', function ($q) use ($stateId) {
            $q->where('ticket_state_id', $stateId)
                ->where('is_current', true);
        });
    }

    /**
     * Scope a query to filter tickets by their creation date.
     * 
     * @param  Builder  $query
     * @param  string  ...$dates
     * @return Builder
     * @throws ValidationException
     */
    public function scopeStartBetween(Builder $query, ...$dates): Builder
    {
        if (count($dates) === 1) {
            $query->whereDate('created_at', '>=', $dates[0]);
        } elseif (count($dates) === 2) {
            $query->whereBetween('created_at', $dates);
        }

        return $query;
    }
}
