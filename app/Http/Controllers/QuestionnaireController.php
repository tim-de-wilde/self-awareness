<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionnaireController extends Controller
{
    public function index(): View
    {

        # get array with questions

        # set up the startingpoint view

        return view('questionnaire.question',[]);

    }

}
