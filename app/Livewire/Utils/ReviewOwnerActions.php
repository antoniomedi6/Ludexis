<?php

namespace App\Livewire\Utils;

use App\Models\Game;
use App\Models\GameUser;
use App\Services\GameScoreService;
use Livewire\Component;

class ReviewOwnerActions extends Component
{
    public GameUser $review;

    public bool $confirmingDelete = false;

    public function mount(GameUser $review): void
    {
        $this->review = $review;
    }

    public function render()
    {
        return view('livewire.utils.review-owner-actions');
    }

    /* EDITAR */
    public function edit(): void
    {
        $this->authorize('update', $this->review);

        // Abre la modal de reseña existente para este juego
        $this->dispatch('evtOpenReviewModal', gameId: $this->review->game_id);
    }

    /* BORRAR */
    public function openDelete(): void
    {
        $this->authorize('delete', $this->review);

        $this->confirmingDelete = true;
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->review);

        // Conserva el registro, solo elimina el texto de la reseña
        $game = $this->review->game_id ? $this->review->game()->first() : null;

        $this->review->review = null;
        $this->review->save();

        if ($game instanceof Game) {
            app(GameScoreService::class)->recalculate($game->refresh());
        }

        // Refresca el perfil para recargar la lista de reseñas
        $this->dispatch('evtUserProfileRefresh');
        $this->confirmingDelete = false;
        $this->dispatch('notify', message: 'Reseña eliminada correctamente.', type: 'success');
    }
}

