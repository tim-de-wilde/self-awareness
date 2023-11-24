<div>
    <div>

        <p>The questionnaire title is: {{$questionaire_title}}</p>
        <p>The question title is: {{$title}}</p>
        <p>The description is: {{$description}}</p>
        <p> the image location is: {{$img_loc}}</p>
        <p>My current answer is: {{$current_value}} </p>
        <input type="number" min="1" max="100" value="50" wire:model.lazy="current_value" >


        <div>
            <button wire:click="back" style="  background-color: white; color: black; border: 2px solid #04AA6D;">back</button>
            <button wire:click="next" style="  background-color: white; color: black; border: 2px solid #04AA6D;">next</button>
        </div>
    </div>
</div>
