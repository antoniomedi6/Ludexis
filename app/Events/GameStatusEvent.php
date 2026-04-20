<?php

namespace App\Events;

use App\Models\Game;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Evento disparado cuando un usuario actualiza el estado de un juego en su biblioteca
 * (ej. "Jugando", "Completado", "Abandonado"). Contiene la información necesaria para que
 * el Listener correspondiente genere un registro en el Timeline (tabla Activities).
 */
class GameStatusEvent
{
    // TRAITS
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public User $user,
        public Game $game,
        public string $newStatus
    ) {
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}