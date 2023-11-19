<?php

namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagePatientAndQuestionnaireController extends Controller
{
    public function index(): View
    {
        return view('psychologist.patient-and-questionnaire.index');
    }
}
