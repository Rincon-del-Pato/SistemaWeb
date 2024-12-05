<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommandTicketItem extends Model
{
    protected $fillable = [
        'command_ticket_id',
        'menu_item_id',
        'quantity',
        'special_requests'
    ];

    public function commandTicket(): BelongsTo
    {
        return $this->belongsTo(CommandTicket::class);
    }

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }
}