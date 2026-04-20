<?php

namespace App\Listeners;

use App\Events\GameStatusEvent;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RecordActivityListener
{

    /**
     * Listener encargado de procesar los eventos de estado de los videojuegos.
     * Intercepta el GameStatusEvent y registra o actualiza la actividad en el Timeline.
     * Utiliza lógica de agrupación por día para evitar llenar el feed de spam si el
     * usuario cambia de estado el mismo juego varias veces en la misma jornada.
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
        Activity::updateOrCreate(
            [
                'user_id' => $event->user->id,
                'game_id' => $event->game->id,
                'action_type' => $event->newStatus,
                'created_at' => Carbon::today(),
            ],
            [
                'details' => [
                    'status' => $event->newStatus,
                    'last_interaction' => now()->toTimeString(),
                    'source' => 'registry_card'
                ],
            ]
        );
    }
}