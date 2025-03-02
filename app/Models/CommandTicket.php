<?php

namespace App\Models;

use App\Enums\CommandStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommandTicket extends Model
{
    protected $fillable = [
        'order_id',
        'status'
    ];

    // Remover completamente el cast del enum
    // No usar protected $casts aquí

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CommandTicketItem::class);
    }

    public function logs(): HasMany
    {
        return $this->hasMany(CommandTicketLog::class);
    }
}
