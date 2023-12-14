<?php

namespace App\Livewire\Psychologist\Questionnaire;

use App\Models\Question;
use App\Models\Questionnaire;
use App\Traits\ManagesModal;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportRedirects\HandlesRedirects;

class CreateOrEdit extends Component
{
    use ManagesModal;

    use HandlesRedirects;

    public ?Questionnaire $questionnaire = null;

    public array $stagedQuestionnaireData = [];

    public array $stagedQuestions = [];

    public array $stagedQuestion = [];

    protected array $rules = [
        'stagedQuestionnaireData.name' => 'required|string',
        'stagedQuestionnaireData.description' => 'nullable|string',
        'stagedQuestions' => 'array',
    ];

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

            $this->stagedQuestionnaireData = $this->questionnaire->only([
                'name',
                'description',
            ]);
        }
    }

    public function save(): void
    {
        $this->validate();

        $questionnaire = $this->questionnaire;
        $stagedQuestionnaire = $this->stagedQuestionnaireData;

        if ($questionnaire instanceof Questionnaire) {
            $questionnaire->update($stagedQuestionnaire);
        } else {
            $questionnaire = Questionnaire::create($stagedQuestionnaire + [
                'user_id' => Auth::id(),
            ]);
        }

        $questionnaire->questions()->delete();

        foreach ($this->stagedQuestions as $question) {
            $questionnaire->questions()->create(
                [
                    'title' => $question['title'],
                    'description' => $question['description'],
                    'asset_location' => asset('images/animals.png'),
                ],
                ['order' => $question['order']]
            );
        }

        $this->back();
    }

    public function back(): void
    {
        $this->redirectRoute('psychologist.manage.index');
    }

    public function editQuestion(string $id): void
    {
        $this->stagedQuestion = $this->getStagedQuestionById($id);
        $this->openModal();
    }

    public function getStagedQuestionById(string $id): array
    {
        return Arr::first(
            $this->stagedQuestions,
            fn (array $data) => (string) $data['id'] === $id
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
        //todo add file stuff
        $this->validate([
            'stagedQuestion.title' => 'required|string',
            'stagedQuestion.description' => 'required|string',
        ])['stagedQuestion'];

        $stagedQuestion = $this->stagedQuestion;

        if (array_key_exists('id', $stagedQuestion)) {
            $this->stagedQuestions = Arr::map($this->stagedQuestions, function (array $data) use ($stagedQuestion) {
                if ((string) $data['id'] === (string) $stagedQuestion['id']) {
                    return $stagedQuestion;
                }

                return $data;
            });
        } else {
            $this->stagedQuestions[] = $stagedQuestion + [
                'id' => Str::uuid()->toString(),
                'preview_image' => Question::getDefaultPreviewImage(),
                'order' => count($this->stagedQuestions) + 1,
            ];
        }

        $this->stagedQuestion = [];

        $this->closeModal();
    }

    public function render(): View
    {
        return view('livewire.psychologist.questionnaire.create-or-edit');
    }
}
