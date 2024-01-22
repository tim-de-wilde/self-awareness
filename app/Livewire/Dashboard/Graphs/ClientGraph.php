<?php

namespace App\Livewire\Dashboard\Graphs;

use App\Enums\Role;
use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\TreatmentPlan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class ClientGraph extends Component
{
    public User $client;

    public string $questionnaireId;

    public string $submittedByUserType;

    public ?string $from = null;

    public ?string $to = null;

    public Collection $users;

    public Collection $questionnaires;

    public function render(): View
    {
        return view('livewire.dashboard.graphs.client-graph', [
            'graphData' => $this->getGraphData()
        ]);
    }

    public function mount(): void
    {
        /** @var TreatmentPlan $treatmentPlan */
        $treatmentPlan = $this->client->clientTreatmentPlan()->first();

        $this->questionnaires = $treatmentPlan->questionnaires()->get();

        $this->prefillOptions();

        $this->updateChart();
    }

    public function prefillOptions(): void
    {
        $this->graphType = 'line';

        $this->questionnaireId = $this->questionnaires->first()->id;
        $this->submittedByUserType = Role::Client->value;
    }

    /**
     * @param ?Answer $a
     * @param ?Answer $b
     * @return Collection<Carbon>
     */
    private function getDatesBetween(?Answer $a, ?Answer $b): Collection
    {
        $out = new Collection();
        /** @var ?Carbon $from */
        $from = $a?->created_at;
        /** @var ?Carbon $to */
        $to = $b?->created_at;

        if ($from instanceof Carbon && $to instanceof Carbon) {
            while ($from->isBefore($to) || $from->isSameDay($to)) {
                $out->push($from->clone());
                $from = $from->addDay();
            }
        }

        return $out;
    }

    public function getGraphData(): array
    {
        /** @var Questionnaire $questionnaire */
        $questionnaire = Questionnaire::query()->find($this->questionnaireId);
        /** @var TreatmentPlan $treatmentPlan */
        $treatmentPlan = $this->client->clientTreatmentPlan()->first();

        $answerQuery = $questionnaire->getAnswerQuery(
            $treatmentPlan,
            Role::from($this->submittedByUserType)
        );
        $answers = $answerQuery
            ->with('question')
            ->when(! empty($this->from), fn (Builder $q) => $q->whereDate('created_at', '>=', $this->from))
            ->when(! empty($this->to), fn (Builder $q) => $q->whereDate('created_at', '<=', $this->to))
            ->orderBy('created_at')
            ->get();

        $dates = $this->getDatesBetween(
            $answers->first(),
            $answers->last(),
        );

        $labels = $dates->map(fn (Carbon $date) => $date->format('d-m-Y'));

        $mappedByQuestion = [];

        foreach ($answers as $answer) {
            $title = $answer->question?->title ?? '';

            if (! array_key_exists($title, $mappedByQuestion)) {
                $mappedByQuestion[$title] = [];
            }

            $mappedByQuestion[$title][] = $answer->value;
        }

        $sets = [];
        foreach ($mappedByQuestion as $key => $answers) {
            $sets[] = [
                'label' => $key,
                'data' => $answers,
            ];
        }

        return [
            'labels' => $labels->toArray(),
            'datasets' => $sets,
        ];
    }

    public function updated(string $property): void
    {
        if (in_array($property, ['questionnaireId', 'submittedByUserType', 'from', 'to'])) {
            $this->updateChart();
        }
    }

    public function updateChart(): void
    {
        $this->dispatch('updateChart', $this->getGraphData());
    }
}
