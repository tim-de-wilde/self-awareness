<?php

namespace App\Livewire\General;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\Questionnaire;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;


class ViewQuestionnaire extends Component
{
    public int $index = 0;
    public int $arraySize;
    public array $answers;
    public int $currentValue;
    public string $title;
    public string $description;
    public string $imgLoc;
    public Questionnaire $questionnaire;
    public array $questions;
    public Answer $answer;
    public string $questionnaireTitle;
    public bool $isFinished = false;

    private function putAnswers(): void
    {
        foreach ($this->answers as $element) {
            Answer::create([
                'questionnaire_id'=> $element[0],
                'question_id'=> $element[1],
                'treatment_plan_id'=> 1,
                'user_id'=>  Auth::id(),
                'value' => $element[2]
            ]);
        }

        $this->isFinished = true;
    }

    public function mount(Questionnaire $questionnaire): void
    {
        $this->questionnaire = $questionnaire;
        $this->questions = $questionnaire
            ->questions()
            ->get()
            ->toArray();
        $this->questionnaireTitle = $this->questionnaire['name'];
        //inits the answer field with the correct data
        $i = 0;
        foreach ($this->questions as $element){
            $this->answers[$i]= [$element['pivot']['questionnaire_id'], $element['pivot']['question_id'], null];
            $i++;
        }

        $this->arraySize = count($this->questions);
        $this->setQuestion(0);
    }


    public function setQuestion(int $localIndex): void
    {   
        $this->title = $this->questions[$localIndex]['title'];
        $this->description =$this->questions[$localIndex]['description'];
        $this->imgLoc = $this->questions[$localIndex]['asset_location'];

        if ($this->answers[$localIndex][2] !== null){
            $this->currentValue = $this->answers[$localIndex][2];
        } else {
            $this->currentValue = 50;
        }
    }


    public function render(): View
    {   
        return view('livewire.general.view-questionnaire');
    }

    public function back(): void
    {
        $this->answers[$this->index][2] = $this->currentValue;
        if($this->index > 0) {
            $this->index = $this->index -1;
            $this->setQuestion($this->index);
        } else {
            $this->setQuestion(0);
        }
    }

    public function next(): void
    {
        #save results
        $this->answers[$this->index][2]= $this->currentValue;

        if($this->index < ($this->arraySize - 1)){
            $this->index=$this->index + 1;
            $this->setQuestion($this->index);
        } elseif($this->index === ($this->arraySize - 1)){
            $this->putAnswers();
            //set variable for finishing screen
        }
    }
}
