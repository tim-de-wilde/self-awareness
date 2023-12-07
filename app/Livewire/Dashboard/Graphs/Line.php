<?php

namespace App\Livewire\Dashboard\Graphs;

use App\Models\Answer;
use App\Models\TreatmentPlan;
use App\Models\User;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use function Laravel\Prompts\select;
use function Laravel\Prompts\table;

class Line extends Component
{
    public Collection $answers;
    public array $treatmentPlan;


    public function mount(User $client)
    {
        /** @var TreatmentPlan $treatmentPlan */
        $treatmentPlan = $client->clientTreatmentPlan()->first();

        $this->answers= $treatmentPlan->answers()->get();


    }
    public function listPersons(): array
    {
         $persons= array();
         $query= $this->answers->unique('user_id')->values()->toArray();


         $names = $this->answers->map(
             function (Answer $answer) {
                 $user = $answer->user()->get();
                 return [
                     'first_name' => $user->name,
                     'last_name' => $user->last_name,
                 ];
             }
         );


         foreach ($query as $element)
         {
             DB::table('users')->select(['name,las_name'])->get();

           //get the name and lastname based on the ids form the $element
             //add them to the array

         }
     return $persons;

    }
    public function listQuestionnaires(): array
    {
        $listQuestionnaires=[];
        return $listQuestionnaires;
    }
    public function listQuestions($questionnaireId): array
    {
        $listQuestions = [];
        DB::table('questions');
        //get the questions from the questionnaire
        // add them to a multi-dimensional array with id, title

        return $listQuestions;
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
        $this->listPersons();
        return view('livewire.dashboard.graphs.line');
    }
}
