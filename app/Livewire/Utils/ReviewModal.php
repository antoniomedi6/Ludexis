<?php

namespace App\Livewire\Utils;

use App\Livewire\Forms\ReviewForm;
use App\Models\Game;
use App\Models\GameUser;
use App\Services\GameScoreService;
use Livewire\Attributes\On;
use Livewire\Component;

class ReviewModal extends Component
{
    public ReviewForm $cform;
    public $modalOpen = false;
    public $game = null;
    public GameScoreService $gameScoreService;

    #[On('evtOpenReviewModal')]
    public function loadModal($gameId)
    {
        $this->game = Game::find($gameId);
        $this->cform->game_id = $gameId;

        $data = GameUser::where('user_id', auth()->id())
            ->where('game_id', $gameId)
            ->first();

        $this->cform->review = $data->review ?? '';

        $this->modalOpen = true;
    }

    public function render()
    {
        return view('livewire.utils.review-modal');
    }

    public function save()
    {
        $this->cform->saveForm();
        $this->modalOpen = false;

        if ($this->game) {
            $this->gameScoreService->recalculate($this->game->refresh());
        }

        $this->dispatch('notify', message: 'Reseña publicada', type: 'success');
    }

    public function cancel()
    {
        $this->cform->cancelForm();
    }
}