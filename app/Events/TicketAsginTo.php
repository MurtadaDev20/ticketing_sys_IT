<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketAsginTo implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ticketAsgin;

    public function __construct($ticketAsgin)
    {
        $this->ticketAsgin = $ticketAsgin;
    }

    public function broadcastOn()
    {
        return new Channel('ticketAsginToSupport');
    }

    public function broadcastWith()
    {
        return [
            'support_id' => $this->ticketAsgin->support_id,
        ];
    }
}
