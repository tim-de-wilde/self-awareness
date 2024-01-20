@php
    use App\Enums\GraphType;
    use App\Enums\Role;
@endphp

<div class="w-full h-full">
    {{-- Inputs for questionnaire, submitted by, date. --}}
    <div class="space-y-4 pb-2">
        <div class="flex space-x-4">
            <div class="flex-1">
                <x-input-label for="questionnaire" :value="__('Questionnaire')"/>
                <x-select :canBeEmpty="false" wire:model.live="questionnaireId">
                    @foreach($questionnaires as $questionnaire)
                        <option value="{{ $questionnaire->id }}">
                            {{ $questionnaire->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="flex-1">
                <x-input-label for="submitted_by" :value="__('Submitted by')"/>
                <x-select :canBeEmpty="false" wire:model.live="submittedByUserType">
                    @foreach(Role::cases() as $role)
                        <option value="{{ $role->value }}">
                            {{ $role->label() }}
                        </option>
                    @endforeach
                </x-select>
            </div>
        </div>
    </div>

    <canvas class="w-full" id="chart"></canvas>

    <div class="flex space-x-4">
        <div class="flex-1">
            <div>
                <x-input-label for="from" :value="__('From')"/>
                <x-text-input wire:model.live="from" type="date" class="mt-1 w-full"/>
            </div>
        </div>
        <div class="flex-1">
            <div>
                <x-input-label for="to" :value="__('To')"/>
                <x-text-input wire:model.live="to" type="date" class="mt-1 w-full"/>
            </div>
        </div>
    </div>
</div>
@once
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush
@endonce

@script
<script>
    const chart = new Chart(document.getElementById('chart'), {
        type: 'line',
        data: @json($graphData),
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    })

    $wire.on('updateChart', data => {
        chart.data = data[0];

        console.log(data)
    })
</script>
@endscript