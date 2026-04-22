<?php

namespace App\Livewire\Forms;

use App\Services\GameScoreService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ReviewForm extends Form
{
    public GameScoreService $gameScoreService;

    #[Validate(['required', 'string', 'min:5', 'max:500'])]
    public string $review = '';

    #[Validate(['required', 'integer', 'exists:games,id'])]
    public int $game_id;

    public function saveForm()
    {
        $this->validate();
        $user = Auth::user();

        $weight = $this->gameScoreService->weightForUser($user);

        DB::table('game_user')
            ->updateOrInsert(
                ['user_id' => $user->id, 'game_id' => $this->game_id],
                [
                    'review' => $this->review,
                    'weight_applied' => $weight,
                    'updated_at' => now(),
                ]
            );
    }

    public function cancelForm()
    {
        $this->resetValidation();
        $this->reset();
    }
}