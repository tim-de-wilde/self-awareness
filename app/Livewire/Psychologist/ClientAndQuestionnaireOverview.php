<?php

namespace App\Livewire\Psychologist;

use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClientAndQuestionnaireOverview extends Component
{
    public string $search = '';

    protected array $queryString = ['search'];

    public function render(): View
    {
        /** @var User $user */
        $user = Auth::user();

        $colors = ['orange', 'red', 'green'];

        $questionnaireColorPair = $user->ownedQuestionnaires()
            ->where('name', 'like', '%'. $this->search . '%')
            ->get()
            ->map(fn (Questionnaire $questionnaire, int $index) => [
                'questionnaire' => $questionnaire,
                'color' => $colors[$index % 3]
            ]);

        return view('livewire.psychologist.client-and-questionnaire-overview', [
            'clients' => $user->clients()
                ->when(! empty($this->search), function (Builder $query) {
                    $query->whereRaw('concat(name, " ", last_name) like "%' . $this->search . '%"');
                })
                ->get(),
            'questionnairePairs' => $questionnaireColorPair,
        ]);
    }


}
