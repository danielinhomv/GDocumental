<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class comentarioCitaEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $mensaje;
    public $user_id;
    public $nombre_completo;
    public function __construct($mensaje,$user_id,$nombre_completo)
    {
        $this->mensaje=$mensaje;
        $this->user_id=$user_id;
        $this->nombre_completo=$nombre_completo;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('comentario-cita'),
        ];
    }
    public function broadcastAs()
    {
        return 'comentario';
    }
}
