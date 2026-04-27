<?php

namespace App\Livewire\Utils;

use App\Models\User;
use Livewire\Component;

class SearchUsers extends Component
{
    public string $search = '';

    public function render()
    {
        $users = collect();

        /* strlen: no consultar a la BBDD hasta 2 o más caracteres */
        if (strlen($this->search) >= 2) {
            $users = User::query()
                ->whereNull('banned_at')
                ->where('name', 'like', '%' . $this->search . '%')
                ->orderBy('name')
                ->select(['id', 'name', 'profile_photo_path'])
                ->limit(8)
                ->get();
        }

        return view('livewire.utils.search-users', compact('users'));
    }
}
