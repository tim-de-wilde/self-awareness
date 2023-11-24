<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Questionnaire;
use App\Models\Answer;


class Question extends Component
{   public $index;
    public $array_size;
    public array $answers;
    public $current_value;
    public $title;
    public $description;
    public $img_loc;

    public Questionnaire $questionnaire;
    public array $questions;
    public Answer $answer;

    public $questionaire_title;


    private function put_answers(){
      //  $this.$this->answer->update();
        #insert answers into database
    }

    #init is overridden here
    public function mount($questionnaire){

        $this->questionnaire = $questionnaire;
        $this->questions = $questionnaire->questions()->get()->toArray();
        $this->questionaire_title = $this->questionnaire['name'];
        //inits the answer field with the correct data
        $i=0;
        foreach ($this->questions as $element){
            $this->answers[$i]= array( $element["pivot"]["questionnaire_id"],  $element["pivot"]["question_id"],null);
            $i++;
        }

        $this->array_size = sizeof($this->questions);
        $this->set_question(0);



        $this->index=0;


    }


    public function set_question($local_index)
    {   
        $this ->title = $this->questions[$local_index]["title"];
        $this ->description =$this->questions[$local_index]["description"];
        $this ->img_loc = $this->questions[$local_index]['asset_location'];

        if($this->answers[$local_index][2]== !null){
            $this->current_value = $this->answers[$local_index][2];
        }
        else{
            $this->current_value=50;
        }
        return null;
    }


    public function render()
    {   
        return view('livewire.question');
    }

    public function back()
    {
        $this->answers[$this->index][2]= $this->current_value;
        if($this->index > 0){
            $this->index = $this->index -1;
            $this->set_question($this->index);
        }
        else{
            $this->set_question(0);
        }
    }

    public function next()
    {
        #save results
        $this->answers[$this->index][2]= $this->current_value;

        if($this->index < ($this->array_size-1)){
            $this->index=$this->index+1;
            $this->set_question($this->index);
        }
        elseif($this->index==($this->array_size-1)){
            dump("new screen");
            dump($this->answers);
        
        }
        else{
            return null;
        }

    }

}
