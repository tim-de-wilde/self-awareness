<div>
    <div id="container"></div>
</div>

@once
    @push('scripts')
        <script type="text/javascript">
            document.addEventListener('livewire:load', function () {
                const Highcharts = require('highcharts')

                require('highcharts/modules/exporting')(Highcharts)

                Highcharts.chart('container', {
                    type: 'line'
                })

                console.log('hoi');
            })
        </script>
    @endpush
@endonce