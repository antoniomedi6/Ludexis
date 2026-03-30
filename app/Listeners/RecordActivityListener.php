<?php

namespace App\Listeners;

use App\Events\GameStatusEvent;
use App\Models\Activity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RecordActivityListener
{
    /**
     * Create the event listener.
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
        Activity::create([
            'user_id' => $event->user->id,
            'game_id' => $event->game->id,
            'action_type' => 'status_changed',
            'details' => [
                'status' => $event->newStatus,
            ],
        ]);
    }
}