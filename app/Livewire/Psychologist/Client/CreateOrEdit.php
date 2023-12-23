<?php

namespace App\Livewire\Psychologist\Client;

use App\Enums\Gender;
use App\Enums\Role;
use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use Livewire\Features\SupportRedirects\HandlesRedirects;

class CreateOrEdit extends Component
{
    use HandlesRedirects;

    public ?User $client = null;

    public array $data = [];

    public array $selectedQuestionnaireIds = [];

    public function mount(): void
    {
        $client = $this->client;

        if ($client instanceof User) {
            $this->data = ['birth_date' => $client->birth_date->format('Y-m-d')] + $client->toArray();

            $this->selectedQuestionnaireIds = $client
                ->clientTreatmentPlan()
                ->first()
                ->questionnaires()
                ->get()
                ->pluck('id')
                ->toArray();
        }
    }

    public function render(): View
    {
        return view('livewire.psychologist.client.create-or-edit', [
            'client' => $this->client,
        ]);
    }

    public function getQuestionnaires(string $query): array
    {
        $selectedQuestionnaireIds = $this->selectedQuestionnaireIds;

        return Questionnaire::query()
            ->whereIn('id', $selectedQuestionnaireIds)
            ->orWhere('name', 'like', "%$query%")
            ->limit(count($selectedQuestionnaireIds) + 5)
            ->get()
            ->map(fn (Questionnaire $questionnaire) => [
                'id' => $questionnaire->id,
                'name' => $questionnaire->name,
            ])
            ->toArray();
    }

    protected function rules(): array
    {
        $emailRule = Rule::unique('users', 'email');

        if ($this->client instanceof User) {
            $emailRule = $emailRule->ignore($this->client->id);
        }

        return [
            'data.name' => 'required|string',
            'data.last_name' => 'required|string',
            'data.email' => ['required', $emailRule],
            'data.gender' => ['required', new Enum(Gender::class)],
            'data.birth_date' => 'required|date',
            'data.phone' => 'nullable|string',
            'selectedQuestionnaireIds' => 'nullable|array',
            'selectedQuestionnaireIds.*' => 'exists:questionnaires,id',
        ];
    }

    public function save(): void
    {
        $client = $this->client;
        $data = $this->validate()['data'];
        $questionnaireIds = $this->selectedQuestionnaireIds;

        if (! empty($client->id)) {
            $client->update($data);
        } else {
            /** @var User $client */
            $client = User::create(
                ['role' => Role::Client] + $data
            );

            $client->clientTreatmentPlan()->create([
                'psychologist_id' => Auth::id(),
                'parent_id' => $client->getParentId(),
            ]);
        }

        $client
            ->clientTreatmentPlan()
            ->first()
            ->questionnaires()
            ->sync($questionnaireIds);

        $this->redirectRoute('psychologist.client.show', [
            'client' => $client->id
        ]);
    }
}
