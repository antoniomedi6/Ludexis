<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ReviewForm extends Form
{
    #[Validate(['required', 'string', 'min:5', 'max:500'])]
    public string $body = '';

    #[Validate(['required', 'integer', 'exists:games,id'])]
    public int $game_id;

    public function saveForm()
    {
        $data = $this->validate();
        $user = Auth::user();

        $data['user_id'] = $user->id;

        switch ($user->role) {
            case 'admin':
            case 'journalist':
                $data['weight_applied'] = 3;
                break;
            case 'veteran':
            case 'standard':
            default:
                $data['weight_applied'] = 1;
                break;
        }

        $score = DB::table('game_user')
            ->where('user_id', $user->id)
            ->where('game_id', $this->game_id)
            ->value('rating');

        $data['score'] = $score ?? 0;

    }
}