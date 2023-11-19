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
        return view('psychologist.patient.createOrEdit');
    }

    public function edit(User $patient): View
    {
        return view('psychologist.patient.createOrEdit', [
            'patient' => $patient,
        ]);
    }

    public function store(): RedirectResponse
    {
        //todo Implement

        return redirect()->back();
    }

    public function update(User $patient): RedirectResponse
    {
        //todo Implement

        return redirect()->back();
    }

    public function delete(User $patient): RedirectResponse
    {
        $patient->delete();

        return redirect()->back();
    }
}
