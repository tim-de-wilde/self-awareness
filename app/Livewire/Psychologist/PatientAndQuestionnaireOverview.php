<?php

namespace App\Livewire\Psychologist;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PatientAndQuestionnaireOverview extends Component
{
    public string $search = '';

    protected array $queryString = ['search'];

    public function render(): View
    {
        /** @var User $user */
        $user = Auth::user();

        return view('livewire.psychologist.patient-and-questionnaire-overview', [
            'patients' => $user->patients()
                ->where('last_name', 'like', '%' . $this->search . '%')
                ->get(),
            'questionnaires' => $user->ownedQuestionnaires()
                ->where('name', 'like', '%' . $this->search . '%')
                ->get(),
        ]);
    }
}
