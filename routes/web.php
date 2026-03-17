<?php

use App\Http\Controllers\RoadmapController;
use App\Livewire\Vistas\AllGames;
use App\Livewire\Vistas\ShowGame;
use App\Livewire\Vistas\WithLogin\Dashboard;
use App\Livewire\Vistas\WithLogin\MyLibrary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/myLibrary', MyLibrary::class)->name('library');
});

Route::get('/allGames', AllGames::class)->name('allGames');
Route::get('/game/{game}', ShowGame::class)->name('games.show');

Route::get('/roadmap', [RoadmapController::class, 'index'])->name('roadmap');

/*
Route::redirect('/register', '/');
Route::redirect('/login', '/');
 */