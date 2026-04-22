<?php

// use App\Http\Controllers\RoadmapController;
// use App\Livewire\Playground;
use App\Http\Controllers\Auth\DiscordAuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\SteamAuthController;
use App\Livewire\Vistas\AllGames;
use App\Livewire\Vistas\FeedSocial;
use App\Livewire\Vistas\Gallery;
use App\Livewire\Vistas\ShowGame;
use App\Livewire\Vistas\ShowUserProfile;
use App\Livewire\Vistas\WithLogin\Admin\Reports;
use App\Livewire\Vistas\WithLogin\Dashboard;
use App\Livewire\Vistas\WithLogin\Lists\ShowCustomLists;
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
    /* RUTAS PARA USUARIOS AUTENTICADOS */
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/myLibrary', MyLibrary::class)->name('library');
    Route::get('/feedSocial', FeedSocial::class)->name('social');
    Route::get('/timeline', UserTimeline::class)->name('timeline');
    Route::get('/userLists', ShowCustomLists::class)->name('userLists');
    Route::get('/userLists/{list}', ShowUserList::class)->name('userLists.show');
    /* RUTAS ADMIN */
    Route::get('/admin/reports', Reports::class)->middleware('admin')->name('admin.reports');
});

/* RUTAS ACCESIBLES PARA USUARIOS SIN AUTENTICAR */
Route::get('/allGames', AllGames::class)->name('allGames');
// Route::get('/playground', Playground::class)->name('playground');
Route::get('/game/{game}', ShowGame::class)->name('games.show');
Route::get('/gallery/{slug?}', Gallery::class)->name('gallery');
// Route::get('/roadmap', [RoadmapController::class, 'index'])->name('roadmap');
Route::get('/profile/{userId}', ShowUserProfile::class)->name('profile');

/**
 * LOGIN SOCIALITE
 */

/* STEAM */
Route::get('/auth/steam/redirect', [SteamAuthController::class, 'redirect'])->name('auth.steam.redirect');
Route::get('/auth/steam/callback', [SteamAuthController::class, 'callback'])->name('auth.steam.callback');

/* DISCORD */
Route::get('/auth/discord/redirect', [DiscordAuthController::class, 'redirect'])->name('auth.discord.redirect');
Route::get('/auth/discord/callback', [DiscordAuthController::class, 'callback'])->name('auth.discord.callback');

/* GOOGLE */
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');