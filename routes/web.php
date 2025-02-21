<?php

use App\Http\Controllers\FuelController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FuelController::class, 'index'])->name('index');

Route::get('/raw', [FuelController::class, 'rawData'])->name('raw');

Route::get('/source', function () {
    return view('components.sourcePage');
})->name('source');

Route::get('/raw/{fuelprice}', [FuelController::class, 'show'])->name('rawIndividual');