<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-4 text-2xl font-bold">{{ __("Bienvenidos") }}</h1>
                    <div class="flex flex-col justify-center gap-8 md:flex-row">
                        <div class="w-full md:w-1/2 h-96">
                            <h2 class="mb-2 text-xl font-semibold">Estado de las Giftcards</h2>
                            <div id="pie_chart" class="w-full h-full rounded-lg"></div>
                        </div>
                        <div class="w-full md:w-1/2 h-96">
                            <h2 class="mb-2 text-xl font-semibold">Saldo de Giftcards Activas / Inactivas</h2>
                            <div id="chart_div" class="w-full h-full rounded-lg"></div>
                            <p id="totalSaldo">Total de saldo vendido: $</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable(@json($pieConvertion));

            var options = {
                title: 'Estado de las Giftcards',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));

            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['gauge']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var indicatorData = @json($indicatorData);
            var sumTotal = indicatorData
                .filter(item => item[0] === "Activas" || item[0] === "Inactivas")
                .reduce((acc, curr) => acc + curr[1], 0);
            var data = google.visualization.arrayToDataTable(indicatorData);
            var options = {
                title: 'Giftcards Activadas / Inactivas',
                width: 400, height: 120,
                redFrom: 90, redTo: 100,
                yellowFrom: 75, yellowTo: 90,
                minorTicks: 5,
                max: sumTotal
            };

            var chart = new google.visualization.Gauge(document.getElementById('chart_div'));
            chart.draw(data, options);
            document.getElementById('totalSaldo').textContent += sumTotal;
        }
    </script>
</x-app-layout>
