<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $treatmentPlan = Auth::user()->patientTreatmentPlans()->first();

        return view('client.dashboard', [
            'questionnaires' => $treatmentPlan->questionnaires()->get(),
            'currentUser' => Auth::user(),
        ]);
    }
}
