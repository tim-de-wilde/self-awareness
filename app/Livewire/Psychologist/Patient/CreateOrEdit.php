<?php

namespace App\Livewire\Psychologist\Patient;

use App\Enums\Gender;
use App\Enums\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use Livewire\Features\SupportRedirects\HandlesRedirects;

class CreateOrEdit extends Component
{
    use HandlesRedirects;

    public ?User $patient = null;

    public array $data = [];

    public function mount(): void
    {
        $patient = $this->patient;

        if ($patient instanceof User) {
            $this->data = ['birth_date' => $patient->birth_date->format('Y-m-d')] + $patient->toArray();
        }
    }

    public function render(): View
    {
        return view('livewire.psychologist.patient.create-or-edit', [
            'patient' => $this->patient,
        ]);
    }

    protected function rules(): array
    {
        $emailRule = Rule::unique('users', 'email');

        if ($this->patient instanceof User) {
            $emailRule = $emailRule->ignore($this->patient->id);
        }

        return [
            'data.name' => 'required|string',
            'data.last_name' => 'required|string',
            'data.email' => ['required', $emailRule],
            'data.gender' => ['required', new Enum(Gender::class)],
            'data.birth_date' => 'required|date',
            'data.phone' => 'nullable|string',
        ];
    }

    public function save(): void
    {
        $patient = $this->patient;
        $data = $this->validate()['data'];

        if (! empty($patient->id)) {
            $patient->update($data);
        } else {
            $patient = User::create(
                ['role' => Role::Patient] + $data
            );
        }

        $this->redirectRoute('psychologist.patient.show', [
            'patient' => $patient->id
        ]);
    }
}
