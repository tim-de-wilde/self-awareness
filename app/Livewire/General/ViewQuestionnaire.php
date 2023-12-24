<?php

namespace App\Livewire\General;

use App\Models\Question;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Questionnaire;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;


class ViewQuestionnaire extends Component
{
    public Questionnaire $questionnaire;

    public array $questions;

    public array $stagedAnswers;

    public bool $isFinished = false;

    public function mount(): void
    {
        $this->questions = $this->getQuestions();
    }

    public function submitQuestion(): void
    {
        // todo Implement
    }

    public function getQuestions(): array
    {
        return $this->questionnaire
            ->questions()
            ->get()
            ->map(fn (Question $question) => [
                'title' => $question->title,
                'description' => $question->description,
                'assets' => $question->exportAssets(),
            ])
            ->toArray();
    }

    public function render(): View
    {   
        return view('livewire.general.view-questionnaire');
    }
}
