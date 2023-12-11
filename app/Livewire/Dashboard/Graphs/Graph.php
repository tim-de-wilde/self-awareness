<?php

namespace App\Livewire\Dashboard\Graphs;

use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\TreatmentPlan;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class Graph extends Component
{
    public Collection $answers;
    public TreatmentPlan  $treatmentPlan;


    public function mount(User $client): void
    {
        /** @var TreatmentPlan $this->treatmentPlan */
        $this->treatmentPlan = $client->clientTreatmentPlan()->first();
        $this->answers= $this->treatmentPlan->answers()->get();
    }
    public function listPersons(): Collection
    {
        $names = $this->answers->map(
            function (Answer $answer) {
                $user = $answer->user()->first();
                return [
                    "id"=> $user->id,
                    'first_name' => $user->name,
                    'last_name' => $user->last_name,
                ];
            }
        );
        dump($names);
        return $names;
    }

    public function listQuestionnaires(): array
    {
        return $this->treatmentPlan->questionnaires()->get(['questionnaire_id','name'])->toArray();
    }
    public function listQuestions( $questionnaire_id): array
    {
        /** @var Questionnaire $questionnaire */
        $questionnaire = $this->treatmentPlan->questionnaires()
            ->find($questionnaire_id);



        return $questionnaire
            ->questions()
            ->get()
            ->toArray();
    }


    //this function should be part of a controller for the entire graph functionality.
    public function getData(int $userView, int $questionnaireId, int $questionId=-1) : Collection
    {
        if ($questionId == -1) {
            return $this->answers->where(['questionnaire_id', '=', $questionnaireId], ['user_id', '=', $userView]);
        } else {
            return $this->answers->where(['questionnaire_id', '=', $questionnaireId], ['question_id', '=', $questionId], ['user_id', '=', $userView]);
        }
    }






    public function render()
    {
        return view('livewire.graphs.graph');
    }
}
