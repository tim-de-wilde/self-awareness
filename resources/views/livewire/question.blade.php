<div>
    <div>
        <p>{{$title}}</p>
        <p>{{$description}}</p>
        <img src={{$img_loc}}></img>

        <input type="number" value="{{$current_value}}" wire:model.lazy="current_value" >
            my number is {{$current_value}}


        <button wire:click="back">back</button>
        <button wire:click="next">next</button>
    </div>
</div>
