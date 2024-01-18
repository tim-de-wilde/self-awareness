<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('client.dashboard');

Route::get('/welcome/{step}', [WelcomeController::class, 'index'])
    ->name('client.welcome');