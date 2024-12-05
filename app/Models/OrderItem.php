<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_item_id',
        'quantity',
        'price',
        'special_requests',
        'size_name'
    ];

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function commandTicketItem()
    {
        return $this->hasOne(CommandTicketItem::class, 'menu_item_id', 'menu_item_id')
            ->where('command_ticket_id', $this->order->commandTicket->id);
    }
}
