<?php

use App\Http\Controllers\FuelController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FuelController::class, 'index'])->name('index');