<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Questionnaire;


class Question extends Component
{   public $index;
    public $array_size;
    public $answers;
    public $current_value;
    public $title;
    public $description;
    public $img_loc;

    public Questionnaire $questionnaire;
    public array $questions;


    private function put_answers(){
        #insert answers into database
    }

    #init is overridden here
    public function mount($questionnaire){

        $this->questionnaire = $questionnaire;
        $this->questions = $questionnaire->questions()->get()->toArray();
        $this->array_size = sizeof($this->questions);
        $this->set_question(0);
        $this->index=0;


    }


    public function set_question($local_index)
    {   
        $this ->title = $this->questions[$local_index]["title"];
        $this ->description =$this->questions[$local_index]["description"];
        $this ->img_loc = $this->questions[$local_index]['asset_location'];
        $this->current_value=50;

    }


    public function render()
    {   
        return view('livewire.question');
    }

    public function back()
    {   
      
        if($this->index > 0){
            $this->index = $this->index -1;
            $this->set_question($this->index);
            $this->set_question($this->index);
        }
        else{
            $this->set_question(0);
        }
    }

    public function next()
    {   
        if($this->index < ($this->array_size-1)){
            $this->index=$this->index+1;
            $this->set_question($this->index);
        }
        elseif($this->index==($this->array_size-1)){
            dump("new screen");
        
        }
        else{
            
        }

    }

}
