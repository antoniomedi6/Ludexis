<?php

namespace App\Listeners;

use App\Events\GameStatusEvent;
use App\Models\Activity;

class RecordActivityListener
{

    /**
     * Listener encargado de procesar los eventos de estado de los videojuegos.
     * Intercepta el GameStatusEvent y registra o actualiza la actividad en el Timeline.
     * Agrupa por ventana de una hora: si el mismo juego cambia de estado varias veces
     * en esa hora, solo persiste la última transición.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(GameStatusEvent $event): void
    {
        $startOfHour = now()->startOfHour();
        $endOfHour = now()->copy()->endOfHour();

        $details = [
            'status' => $event->newStatus,
            'last_interaction' => now()->toTimeString(),
            'source' => 'registry_card',
        ];

        $activity = Activity::query()
            ->where('user_id', $event->user->id)
            ->where('game_id', $event->game->id)
            ->whereBetween('created_at', [$startOfHour, $endOfHour])
            ->first();

        if ($activity) {
            $activity->update([
                'action_type' => $event->newStatus,
                'details' => $details,
                'created_at' => now(),
            ]);
        } else {
            Activity::create([
                'user_id' => $event->user->id,
                'game_id' => $event->game->id,
                'action_type' => $event->newStatus,
                'details' => $details,
            ]);
        }
    }
}