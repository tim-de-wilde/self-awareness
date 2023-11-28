<?php

namespace App\Livewire\Questionnaire;


use App\Http\Controllers\Controller;
use App\Http\Controllers\QuestionnaireLookup;
use Livewire\Component;

class QuestionnaireList extends Component
{
    public array $questionnaires;

    public function mount(){
        $controller = new QuestionnaireLookup();
        $this->questionnaires= $controller->getQuestionaire();
        dump($this->questionnaires);

    }
    public function render()
    {


        return view('livewire.questionnaire.questionnaire-list');
    }
}
