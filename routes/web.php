<?php

use App\Http\Controllers\RoadmapController;
use App\Livewire\Vistas\AllGames;
use App\Livewire\Vistas\ShowGame;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
});

Route::get('/allGames', AllGames::class)->name('allGames');
Route::get('/game/{game}', ShowGame::class)->name('games.show');

/*
Route::redirect('/register', '/');
Route::redirect('/login', '/');
 */
Route::get('/roadmap', [RoadmapController::class, 'index'])->name('roadmap');