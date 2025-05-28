<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BandController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\ProfileController;

Route::get('/', fn() => redirect()->route('login'));
require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/home', fn() => view('home'))->name('home');

    Route::resource('bands', BandController::class);

    Route::get('/bands-disponibili', [BandController::class, 'explore'])->name('bands.explore');
    Route::get('/browse', [BandController::class, 'browse'])->name('bands.browse');

   Route::resource('bands.requests', RequestController::class)
    ->shallow()
    ->except(['edit', 'update']);

// Apply a una richiesta (usiamo ancora {request})
Route::post('/requests/{request}/apply', [RequestController::class, 'apply'])
    ->name('requests.apply');

// Aggiorna stato candidatura
Route::patch('/requests/{request}/applications/{application}/status', [RequestController::class, 'updateApplicationStatus'])
    ->name('requests.applications.status');

// Show band
Route::get('/bands/{band}', [BandController::class, 'show'])->name('bands.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/track', [ProfileController::class, 'editTrack'])->name('profile.track.edit');
    Route::patch('/profile/track', [ProfileController::class, 'updateTrack'])->name('profile.track.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/spotify/connect', [SpotifyController::class, 'redirectToSpotify'])->name('spotify.connect');
    Route::get('/spotify/callback', [SpotifyController::class, 'handleCallback'])->name('spotify.callback');
    Route::get('/spotify/playlists', [SpotifyController::class, 'showPlaylists'])->name('spotify.playlists');
});
