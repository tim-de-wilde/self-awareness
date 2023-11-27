<?php

use App\Http\Controllers\Psychologist\ManagePatientAndQuestionnaireController;
use App\Http\Controllers\Psychologist\PatientController;
use App\Http\Controllers\Psychologist\QuestionnaireController;
use Illuminate\Support\Facades\Route;

Route::get('manage', [ManagePatientAndQuestionnaireController::class, 'index'])
    ->name('psychologist.manage.index');

// Patients

Route::get('/patients/create', [PatientController::class, 'create'])
    ->name('psychologist.patient.create');

Route::get('/patients/{patient}', [PatientController::class, 'show'])
    ->name('psychologist.patient.show');

Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])
    ->name('psychologist.patient.edit');

Route::post('/patients/{patient}/delete', [PatientController::class, 'delete'])
    ->name('psychologist.patient.delete');

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