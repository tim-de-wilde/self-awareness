<?php

namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    //todo Authentication for entire controller.

    public function show(Questionnaire $questionnaire): View
    {
        return view('psychologist.questionnaire.show', [
            'questionnaire' => $questionnaire,
        ]);
    }

    public function create(): View
    {
        return view('psychologist.questionnaire.createOrEdit');
    }

    public function edit(Questionnaire $questionnaire): View
    {
        return view('psychologist.questionnaire.createOrEdit', [
            'questionnaire' => $questionnaire,
        ]);
    }

    public function store(): RedirectResponse
    {
        //todo Implement

        return redirect()->back();
    }

    public function update(Questionnaire $questionnaire): RedirectResponse
    {
        //todo Implement

        return redirect()->back();
    }

    public function delete(Questionnaire $questionnaire): RedirectResponse
    {
        $questionnaire->delete();
        return redirect()->back();
    }
}
