<?php

namespace App\Livewire\Dashboard\Graphs;

use Livewire\Component;

class Histogram extends Graph
{
    public function render()
    {
        return view('livewire.dashboard.graphs.histogram');
    }
}
