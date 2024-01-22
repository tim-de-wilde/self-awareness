<?php

namespace App\Http\Controllers\Psychologist;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class ClientController extends Controller
{
    //todo Authentication

    public function show(User $client): View
    {
        $questionnaireNames = $client
            ->clientTreatmentPlan()
            ->first()
            ->questionnaires()
            ?->pluck('name')
            ?->join(', ');

        if (empty($questionnaireNames)) {
            $questionnaireNames = __('none');
        }

        return view('psychologist.client.show', [
            'client' => $client,
            'questionnaireNames' => $questionnaireNames,
        ]);
    }

    public function create(): View
    {
        return view('psychologist.client.create');
    }

    public function edit(User $client): View
    {
        return view('psychologist.client.edit', [
            'client' => $client,
        ]);
    }

    public function delete(User $client): RedirectResponse
    {
        $client->delete();
        return redirect()->route('psychologist.dashboard');
    }
}
