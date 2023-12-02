<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionnaireController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/questionnaire/{questionnaire}', [QuestionnaireController::class, 'index'])
    ->middleware(['auth'])
    ->name('questionnaire.index');

    Route::get('/questionnaire/all/{id}', 'QuestionnaireController@show')->name('questionnaire.show');


//routes for making back/logout icons visible and invisible in navigation

Route::get('/client/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/psychologist/dashboard', 'DashboardController@index')->name('dashboard');
 
require __DIR__.'/auth.php';
