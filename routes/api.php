<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RequestApiController;

// Rota di debug utente (Sanctum)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Lista strumenti (pubblica)
Route::get('/instruments', [RequestApiController::class, 'allInstruments']);

// Band con richieste per uno strumento
Route::get('/bands/requests/{instrument}', [RequestApiController::class, 'bandsByInstrument']);
