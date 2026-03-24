<?php

namespace App\Livewire\Utils;

use App\Livewire\Forms\GameRegistryForm;
use App\Livewire\Forms\ReviewForm;
use App\Models\Game;
use App\Models\GameUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GameRegistryCard extends Component
{
    public GameRegistryForm $form;
    public $gameTitle;

    public function mount($gameId)
    {
        $game = Game::findOrFail($gameId);
        $this->gameTitle = $game->title;

        $this->form->game_id = $game->id;
        $this->form->user_id = Auth::id();

        $register = GameUser::where('user_id', Auth::id())
            ->where('game_id', $game->id)
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
        $this->dispatch('evtSaved');
    }

    public function render()
    {
        return view('livewire.utils.game-registry-card');
    }
}