<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $questionnaires = Auth::user()
            ->questionnaires()
            ->get();

        return view('dashboard', ['questionnaires' => $questionnaires]);
    }
}
