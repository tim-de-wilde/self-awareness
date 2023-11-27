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

        # get array with questions

        # set up the startingpoint view

        return view('questionnaire.question',['questionnaire' => $questionnaire]);

    }

}
