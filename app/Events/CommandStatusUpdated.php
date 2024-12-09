<?php

namespace App\Events;

use App\Models\CommandTicket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommandStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $command;

    public function __construct(CommandTicket $command)
    {
        $this->command = $command;
    }

    public function broadcastOn()
    {
        return new Channel('commands');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->command->id,
            'status' => $this->command->status,
            'updated_at' => now()->toIso8601String()
        ];
    }
}