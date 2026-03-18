<?php

namespace App\Livewire\Utils;

use App\Livewire\Forms\GameRegistryForm;
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

        $registro = GameUser::where('user_id', Auth::id())
            ->where('game_id', $game->id)
            ->first();

        if ($registro) {
            $this->form->status = $registro->status;
            $this->form->rating = $registro->rating;
            $this->form->hours_finish = $registro->hours_finish;
            $this->form->hours_completed = $registro->hours_completed;
            $this->form->drop_reason = $registro->drop_reason;
        } else {
            $this->form->status = null;
        }
    }

    public function save()
    {
        $this->form->saveForm();

        session()->flash('message', '¡Registro guardado con éxito!');
    }

    public function render()
    {
        return view('livewire.utils.game-registry-card');
    }
}