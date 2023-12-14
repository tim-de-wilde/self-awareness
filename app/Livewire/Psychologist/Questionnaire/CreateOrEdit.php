<?php

namespace App\Livewire\Psychologist\Questionnaire;

use App\Models\Question;
use App\Models\Questionnaire;
use App\Traits\ManagesModal;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Livewire\Component;

class CreateOrEdit extends Component
{
    use ManagesModal;

    public ?Questionnaire $questionnaire = null;

    public array $stagedQuestions = [];

    public array $stagedQuestionData = [];

    public function mount(): void
    {
        if ($this->questionnaire instanceof Questionnaire) {
            $this->stagedQuestions = $this->questionnaire
                ->questions()
                ->orderByPivot('order')
                ->withPivot('order')
                ->get()
                ->map(
                    fn (Question $question) => [
                        'id' => $question->id,
                        'order' => $question->pivot->order,
                        'title' => $question->title,
                        'description' => $question->description,
                        'preview_image' => $question->getPreviewImage(),
                    ]
                )
                ->toArray();
        }
    }

    public function openModal(): void
    {
        $this->showModal = true;
    }

    public function editQuestion(string $id): void
    {
        $this->stagedQuestionData = $this->getStagedQuestionById($id);
        $this->openModal();
    }

    public function getStagedQuestionById(int $id): array
    {
        return Arr::first(
            $this->stagedQuestions,
            fn (array $data) => $data['id'] === $id
        );
    }

    public function updateQuestionOrder(array $newOrderData): void
    {
        $keyedOrderData = Arr::mapWithKeys(
            $newOrderData,
            fn (array $order) => [$order['value'] => $order['order']]
        );

        $updatedQuestions = Arr::map($this->stagedQuestions, fn (array $data) => ['order' => $keyedOrderData[$data['id']]] + $data);
        $this->stagedQuestions = Arr::sort($updatedQuestions, fn (array $data) => $data['order']);
    }

    public function saveQuestion(): void
    {
        $stagedQuestionData = $this->stagedQuestionData;

        //todo validation

        $this->stagedQuestions = Arr::map($this->stagedQuestions, function (array $data) use ($stagedQuestionData) {
            if ($data['id'] === $stagedQuestionData['id']) {
                return $stagedQuestionData;
            }

            return $data;
        });

        $this->stagedQuestionData = [];

        $this->closeModal();
    }

    public function render(): View
    {
        return view('livewire.psychologist.questionnaire.create-or-edit');
    }
}
