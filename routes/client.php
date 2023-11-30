<?php

use App\Http\Controllers\Client\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('client.dashboard');