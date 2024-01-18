<?php

namespace App\Livewire\General;

use App\Models\Question;
use App\Models\TreatmentPlan;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Questionnaire;
use LogicException;


class ViewQuestionnaire extends Component
{
    public User $user;

    public Questionnaire $questionnaire;

    public TreatmentPlan $treatmentPlan;

    public array $questions;

    public bool $isFinished = false;

    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->user = $user;
        $this->questions = $this->getQuestions();
        $this->isFinished = $this->questionnaire->isCompletedForUser(
            $user,
            $this->treatmentPlan,
        );
    }

    public function submit(array $answers): void
    {
        if (count($answers) !== count($this->questions)) {
            throw new LogicException(
                'Answer count does not match question count.'
            );
        }

        $this->questionnaire->answers()->createMany(
            Arr::map($answers, fn (array $data) => [
                'user_id' => $this->user->id,
                'treatment_plan_id' => $this->treatmentPlan->id,
                'value' => $data['value'],
                'question_id' => $data['question_id'],
            ])
        );

        $this->isFinished = true;
    }

    public function getQuestions(): array
    {
        return $this->questionnaire
            ->questions()
            ->get()
            ->map(fn (Question $question) => [
                'id' => $question->id,
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
