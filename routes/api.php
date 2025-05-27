<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RequestApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/instruments', [RequestApiController::class, 'allInstruments']);

Route::get('/bands/requests/{instrument}', [RequestApiController::class, 'bandsByInstrument']);
