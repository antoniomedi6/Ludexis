<?php

namespace App\Livewire\Utils;

use App\Models\Game;
use Livewire\Attributes\On;
use Livewire\Component;

class ReviewModal extends Component
{

    public $gameId = null;
    public $modalOpen = false;
    public $game = null;
    public function render()
    {
        return view('livewire.utils.review-modal');
    }

    #[On('evtOpenReviewModal')]
    public function cargarModal(?int $gameId = null)
    {
        $this->gameId = $gameId;
        $this->game = Game::find($gameId);
        $this->modalOpen = true;
    }

}