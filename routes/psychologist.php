<?php

use App\Http\Controllers\Psychologist\ManageClientAndQuestionnaireController;
use App\Http\Controllers\Psychologist\ClientController;
use App\Http\Controllers\Psychologist\QuestionnaireController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('psychologist.dashboard');
})->name('psychologist.dashboard');


Route::get('manage', [ManageClientAndQuestionnaireController::class, 'index'])
    ->name('psychologist.manage.index');

// clients

Route::get('/clients/create', [ClientController::class, 'create'])
    ->name('psychologist.client.create');

Route::get('/clients/{client}', [ClientController::class, 'show'])
    ->name('psychologist.client.show');

Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])
    ->name('psychologist.client.edit');

Route::post('/clients/{client}/delete', [ClientController::class, 'delete'])
    ->name('psychologist.client.delete');

// Questionnaires

Route::get('/questionnaires/create', [QuestionnaireController::class, 'create'])
    ->name('psychologist.questionnaire.create');

Route::post('/questionnaires/create', [QuestionnaireController::class, 'store'])
    ->name('psychologist.questionnaire.store');

Route::get('/questionnaires/{questionnaire}', [QuestionnaireController::class, 'show'])
    ->name('psychologist.questionnaire.show');

Route::get('/questionnaires/{questionnaire}/edit', [QuestionnaireController::class, 'edit'])
    ->name('psychologist.questionnaire.edit');

Route::put('/questionnaires/{questionnaire}/edit', [QuestionnaireController::class, 'update'])
    ->name('psychologist.questionnaire.update');

Route::delete('/questionnaires/{questionnaire}', [QuestionnaireController::class, 'delete'])
    ->name('psychologist.questionnaire.delete');