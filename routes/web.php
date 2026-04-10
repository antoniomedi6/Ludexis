<?php

use App\Http\Controllers\RoadmapController;
use App\Livewire\Playground;
use App\Livewire\Vistas\AllGames;
use App\Livewire\Vistas\FeedSocial;
use App\Livewire\Vistas\Gallery;
use App\Livewire\Vistas\ShowGame;
use App\Livewire\Vistas\WithLogin\CustomLists;
use App\Livewire\Vistas\WithLogin\Dashboard;
use App\Livewire\Vistas\WithLogin\Lists\ShowUserList;
use App\Livewire\Vistas\WithLogin\MyLibrary;
use App\Livewire\Vistas\WithLogin\UserTimeline;
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
    Route::get('/feedSocial', FeedSocial::class)->name('social');
    Route::get('/timeline', UserTimeline::class)->name('timeline');
    Route::get('/userLists', CustomLists::class)->name('userLists');
    Route::get('/userLists/{list}', ShowUserList::class)->name('userLists.show');
});

Route::get('/allGames', AllGames::class)->name('allGames');
Route::get('/playground', Playground::class)->name('playground');
Route::get('/game/{game}', ShowGame::class)->name('games.show');
Route::get('/gallery/{slug?}', Gallery::class)->name('gallery');
Route::get('/roadmap', [RoadmapController::class, 'index'])->name('roadmap');

/*
Route::redirect('/register', '/');
Route::redirect('/login', '/');
 */