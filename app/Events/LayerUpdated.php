<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class LayerUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $layer;

    public function __construct($layer)
    {
        $this->layer = $layer;
    }

    public function broadcastOn()
    {
        return new Channel('layers');
    }

    public function broadcastAs()
    {
        return 'LayerUpdated';
    }
}
