<?php

namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PatientController extends Controller
{
    //todo Authentication

    public function show(User $patient): View
    {
        return view('psychologist.patient.show', [
            'patient' => $patient,
        ]);
    }

    public function create(): View
    {
        return view('psychologist.patient.create');
    }

    public function edit(User $patient): View
    {
        return view('psychologist.patient.edit', [
            'patient' => $patient,
        ]);
    }

    public function delete(User $patient): RedirectResponse
    {
        $patient->delete();
        return redirect()->route('psychologist.manage.index');
    }
}
