<?php

namespace App\Events;

use App\Models\Marcaciones;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MarcacionEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Marcaciones $marcacion;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Marcaciones $marcacion)
    {
        $this->marcacion = $marcacion;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('marcaciones.created');
    }

    public function broadcastAs(): string{
        return 'marcaciones.created';
    }
}
