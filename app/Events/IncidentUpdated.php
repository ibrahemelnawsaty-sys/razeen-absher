<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; // changed to immediate broadcast
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IncidentUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $feature;

    /**
     * Create a new event instance.
     *
     * @param array $feature GeoJSON Feature
     */
    public function __construct(array $feature)
    {
        $this->feature = $feature;
    }

    /**
     * The channel the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        return new Channel('incidents');
    }

    /**
     * Custom event name on the frontend.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'IncidentUpdated';
    }

    /**
     * Data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'feature' => $this->feature,
        ];
    }

    /**
     * Only broadcast when feature is present (safety check).
     *
     * @return bool
     */
    public function broadcastWhen(): bool
    {
        return !empty($this->feature) && is_array($this->feature);
    }
}
