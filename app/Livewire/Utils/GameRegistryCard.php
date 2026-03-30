<?php

namespace App\Livewire\Utils;

use App\Events\GameStatusEvent;
use App\Livewire\Forms\GameRegistryForm;
use App\Models\Game;
use App\Models\GameUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GameRegistryCard extends Component
{
    public GameRegistryForm $form;
    public Game $game;

    public function mount($gameId)
    {
        $this->game = Game::findOrFail($gameId);

        $this->form->game_id = $this->game->id;
        $this->form->user_id = Auth::id();

        $register = GameUser::where('user_id', Auth::id())
            ->where('game_id', $this->game->id)
            ->first();

        if ($register) {
            $this->form->status = $register->status;
            $this->form->rating = $register->rating;
            $this->form->review = $register->review;
            $this->form->hours_finish = $register->hours_finish;
            $this->form->hours_completed = $register->hours_completed;
            $this->form->drop_reason = $register->drop_reason;
        } else {
            $this->form->status = null;
        }
    }

    public function save()
    {
        $this->form->saveForm();

        GameStatusEvent::dispatch(Auth::user(), $this->game, $this->form->status);

        $this->dispatch('evtSaved');
    }

    public function render()
    {
        return view('livewire.utils.game-registry-card');
    }
}