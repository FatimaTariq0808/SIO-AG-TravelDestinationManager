<?php

use App\Http\Controllers\DestinationController;
use Illuminate\Support\Facades\Route;

Route::prefix('destinations')->group(function () {
    Route::get('/', [DestinationController::class, 'getAllDestinations']);
    Route::get('/search', [DestinationController::class, 'searchDestinations']);
    Route::get('/{id}', [DestinationController::class, 'getDestinationById']);
    Route::post('/', [DestinationController::class, 'createDestination']);
    Route::put('/{id}', [DestinationController::class, 'updateDestination']);
    Route::delete('/{id}', [DestinationController::class, 'deleteDestination']);
});