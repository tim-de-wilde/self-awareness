<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Questionnaire;

class QuestionnaireController extends Controller
{
    public function index(Questionnaire $questionnaire): View
    {
        return view('general.questionnaire.index', [
            'questionnaire' => $questionnaire
        ]);
    }
}
