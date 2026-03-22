<?php

namespace App\Livewire\Forms;

use App\Models\GameUser;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GameRegistryForm extends Form
{
    #[Validate('required|integer')]
    public int $game_id = 0;

    #[Validate('required|integer')]
    public int $user_id = 0;

    #[Validate('required|string|in:pending,playing,finish,completed,paused,abandoned,multiplayer')]
    public ?string $status = null;

    #[Validate('nullable|numeric|min:0|max:5')]
    public ?float $rating = null;
    #[Validate('nullable|integer|min:0')]
    public ?int $hours_finish = 0;

    #[Validate('nullable|integer|min:0')]
    public ?int $hours_completed = 0;

    #[Validate('nullable|string|max:1000')]
    public ?string $drop_reason = null;

    public function saveForm()
    {
        $this->validate();

        GameUser::updateOrCreate(
            [
                'user_id' => $this->user_id,
                'game_id' => $this->game_id,
            ],
            [
                'status' => $this->status,
                'rating' => $this->rating,
                'hours_finish' => $this->hours_finish,
                'hours_completed' => $this->hours_completed,
                'drop_reason' => $this->drop_reason,
            ]
        );
    }

    public function cancelForm()
    {
        $this->resetValidation();
        $this->reset('status', 'rating', 'hours_finish', 'hours_completed', 'drop_reason');
    }
}