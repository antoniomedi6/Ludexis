<?php

namespace App\Livewire\Utils;

use App\Events\GameStatusEvent;
use App\Livewire\Forms\GameRegistryForm;
use App\Models\Game;
use App\Models\GameUser;
use App\Services\GameScoreService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GameRegistryCard extends Component
{
    public GameRegistryForm $form;
    public Game $game;
    public ?GameUser $gameUser = null;

    public function mount($gameId)
    {
        $this->game = Game::findOrFail($gameId);

        $this->form->game_id = $this->game->id;
        $this->form->user_id = Auth::id();

        $this->gameUser = GameUser::where('user_id', Auth::id())
            ->where('game_id', $this->game->id)
            ->first();

        if ($this->gameUser) {
            $this->form->status = $this->gameUser->status;
            $this->form->rating = $this->gameUser->rating;
            $this->form->review = $this->gameUser->review;
            $this->form->hours_finish = $this->gameUser->hours_finish;
            $this->form->hours_completed = $this->gameUser->hours_completed;
            $this->form->drop_reason = $this->gameUser->drop_reason;
        } else {
            $this->form->status = null;
        }
    }

    public function save()
    {
        $this->form->saveForm();

        $this->gameUser = GameUser::where('user_id', Auth::id())
            ->where('game_id', $this->game->id)
            ->first();

        app(GameScoreService::class)->recalculate($this->game->refresh());

        if ($this->form->status) {
            GameStatusEvent::dispatch(Auth::user(), $this->game, $this->form->status);
        }

        $this->dispatch('evtSaved');
    }

    public function toggleStatus()
    {
        $this->authorize('delete', $this->gameUser);
        if ($this->gameUser) {
            $this->gameUser->delete();
            $this->gameUser = null;
        }
        $this->form->reset();

        app(GameScoreService::class)->recalculate($this->game->refresh());

        $this->dispatch('evtSaved');
    }

    public function render()
    {
        return view('livewire.utils.game-registry-card');
    }
}
