<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommandTicketLog extends Model
{
    protected $fillable = [
        'command_ticket_id',
        'previous_status',
        'new_status',
        'notes'
    ];

    protected $dates = [
        'change_date'
    ];

    public function commandTicket(): BelongsTo
    {
        return $this->belongsTo(CommandTicket::class);
    }
}