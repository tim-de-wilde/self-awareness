<?php

namespace App\Livewire\Dashboard\Graphs;

use App\Models\Answer;
use App\Models\TreatmentPlan;
use App\Models\User;

use Illuminate\Support\Collection;
use Livewire\Component;
use PhpParser\Node\Expr\Array_;
use Tests\Fixtures\Model;

class Line extends Component
{
    public Collection $answers;
    public array $treatmentPlan;




    public function mount(User $client)
    {
        /** @var TreatmentPlan $treatmentPlan */
        $treatmentPlan = $client->clientTreatmentPlan()->first();

        dd(
            $treatmentPlan->answers()->get()
        );
    }
    //this function should be part of a controller for the entire graph functionality.
    private function getData(int $userView, int $questionnaireId, int $questionId=-1) : Collection
    {
        if ($questionId==-1){
            return $this->answers->where(['questionnaire_id', '=', $questionnaireId ],['user_id','=',$userView]);
        }
        else{
            return $this->answers->where(['questionnaire_id', '=', $questionnaireId ],['question_id','=',$questionId],['user_id','=',$userView]);
        }




    }
    public function 
    public function render()
    {
        dump($this->answers);
        dump($this->getData(5,7));
        return view('livewire.dashboard.graphs.line');
    }
}
