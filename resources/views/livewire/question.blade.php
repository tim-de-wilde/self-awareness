<div>
    <div>
        <title>{{$title}}</title>
        <p>{{$description}}</p>
        <img src={{$img_loc}}></img>

        <input type="number" wire:model.lazy="current_value">
            my number is {{$current_value}}
        <button wire:click="back">back</button>
        <button wire:click="next">next</button>
    </div>
</div>
