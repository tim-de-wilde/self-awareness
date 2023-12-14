<?php

namespace App\Livewire\Dashboard\Graphs;

use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\TreatmentPlan;
use App\Models\User;

use Illuminate\Support\Collection;

use Livewire\Component;


class Line extends Graph
{
    public function render()
    {
        return view('livewire.dashboard.graphs.line');
    }
}
