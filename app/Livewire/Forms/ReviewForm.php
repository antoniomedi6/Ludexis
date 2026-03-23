<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ReviewForm extends Form
{
    #[Validate(['required', 'string', 'min:5', 'max:500'])]
    public string $review = '';

    #[Validate(['required', 'integer', 'exists:games,id'])]
    public int $game_id;

    public function saveForm()
    {
        $this->validate();
        $user = Auth::user();

        $weight = match ($user->role) {
            'admin', 'journalist' => 3,
            'veteran' => 1.5,
            default => 1,
        };

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