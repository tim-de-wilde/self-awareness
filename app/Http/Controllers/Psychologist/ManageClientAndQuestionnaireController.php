<?php

namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ManageClientAndQuestionnaireController extends Controller
{
    public function index(): View
    {
        return view('psychologist.client-and-questionnaire.index');
    }
}
