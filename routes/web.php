<?php

use App\Http\Controllers\DestinationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DestinationController::class, 'getAllDestinations'])->name(name: 'destinations.index');