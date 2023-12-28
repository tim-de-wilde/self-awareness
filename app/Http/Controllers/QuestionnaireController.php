<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TreatmentPlan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Questionnaire;

class QuestionnaireController extends Controller
{
    public function index(Questionnaire $questionnaire, TreatmentPlan $treatmentPlan): View
    {
        return view('general.questionnaire.index', [
            'questionnaire' => $questionnaire,
            'treatmentPlan' => $treatmentPlan,
        ]);
    }
}
