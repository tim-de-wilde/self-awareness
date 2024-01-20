<?php

namespace App\Livewire\Psychologist\Client;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Show extends Component
{
    public User $client;

    public string $questionnaireNames;

    public function render(): View
    {
        return view('livewire.psychologist.client.show');
    }
}
