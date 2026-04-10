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