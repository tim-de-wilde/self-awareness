<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $treatmentPlan = Auth::user()->patientTreatmentPlan()->get();
        return view('dashboard', ['questionnaires' => $treatmentPlan->questionnaires()->get()]);
    }
}
