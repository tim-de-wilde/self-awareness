<?php

namespace App\Livewire;

use Livewire\Component;

class Question extends Component
{
    public $array_size;
    public $question_array;
    public $answers;
    public $current_value;
    public $title;
    public $description;
    public $img_loc;


    private function get_questions($questionair_id){
        $question_aray= DB::select("")
        #get data from db
    }
    private function put_answers(){
        #insert answers into database
    }

    #init is overridden here
    public function mount($questionnaire){

        $question_array= array("a","b","c");
        //$this->get_questions($questionair_id);
        $this->array_size=sizeof($question_array);
        dump($this-> array_size);
        //$this->set_question(0);
        $this->current_value=0;

    }


    public function set_question($local_index)
    {
        # set title
        # set description
        # img_loc based on index
        #$this->current_value = 0;
        return $local_index;
    }


    public function render()
    {   
        return view('livewire.question');
    }

    public function back()
    {   
      
        if($this->current_value > 0){
            $this->current_value = $this->current_value -1;
            $this->set_question($this->current_value);
        }
        else{
            $this->set_question(0);

        }
        dump($this->current_value,$this->array_size);

    }

    public function next()
    {   
        if($this->current_value < $this->array_size){
            $this->current_value=$this->current_value+1;
            $this->set_question($this->current_value);
        }
        elseif($this->current_value==$this->array_size){
            $this->set_question($this->array_size);
            dump("final screen");
        }
        else{
            
        }
        dump($this->current_value);

    }

}
