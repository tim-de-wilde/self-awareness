<?php

namespace App\Livewire\Psychologist\Questionnaire;

use App\Models\Questionnaire;
use App\Traits\ManagesModal;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateOrEdit extends Component
{
    use ManagesModal;

    public ?Questionnaire $questionnaire = null;

    public array $questions = [];

    public function render(): View
    {
        return view('livewire.psychologist.questionnaire.create-or-edit');
    }
}
