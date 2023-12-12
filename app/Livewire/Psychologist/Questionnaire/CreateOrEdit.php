<?php

namespace App\Livewire\Psychologist\Questionnaire;

use App\Models\Questionnaire;
use App\Traits\ManagesModal;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class CreateOrEdit extends Component
{
    use ManagesModal;

    public ?Questionnaire $questionnaire = null;

    public array $stagedQuestions = [];

    public function mount(): void
    {
        if ($this->questionnaire instanceof Questionnaire) {
            $this->stagedQuestions = $this->questionnaire
                ->questions()
                ->get()
                ->toArray();
        }
    }

    public function render(): View
    {
        return view('livewire.psychologist.questionnaire.create-or-edit');
    }
}
