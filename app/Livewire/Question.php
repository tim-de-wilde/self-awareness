<?php

namespace App\Livewire;

use Livewire\Component;

class Question extends Component
{
    private $array_size;
    private $question_array;
    public $current_value;
    public $title;
    public $description;
    public $img_loc;



    #init is overridden here
    public function mount(){
        $question_array= array("a","b","c");
        $this->array_size=sizeof($question_array);
        $this->set_question(0);




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
        $loc_val= $this->current_value;
        if($this->current_value > 0){
            $this->current_value = $this->current_value;
            $this->set_question($this->current_value);
        }
        else{
            $this->set_question(0);
        }
        

    }

    public function next()
    {   
        if($this->current_value < $this->array_size){
            $this->current_value=$this->current_value+1;
            $this->set_question($this->current_value);
        }
        elseif($this->current_value==$this->array_size){
            $this->set_question($this->array_size);
        }
        else{
            #run the last screen 
        }

    }

}
