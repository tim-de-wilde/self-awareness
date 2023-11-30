<?php

namespace App\Livewire\Psychologist\Client;

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

    public ?User $client = null;

    public array $data = [];

    public function mount(): void
    {
        $client = $this->client;

        if ($client instanceof User) {
            $this->data = ['birth_date' => $client->birth_date->format('Y-m-d')] + $client->toArray();
        }
    }

    public function render(): View
    {
        return view('livewire.psychologist.client.create-or-edit', [
            'client' => $this->client,
        ]);
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
        ];
    }

    public function save(): void
    {
        $client = $this->client;
        $data = $this->validate()['data'];

        if (! empty($client->id)) {
            $client->update($data);
        } else {
            $client = User::create(
                ['role' => Role::Client] + $data
            );
        }

        $this->redirectRoute('psychologist.client.show', [
            'client' => $client->id
        ]);
    }
}