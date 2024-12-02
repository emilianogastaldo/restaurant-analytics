<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Document</title>
    <!-- Styles -->
    @vite('resources/js/app.js')
</head>
<body>
    @include('includes.navbar')
    <main>
        <div class="container">
            <div class="location-info">
                <h3>{{$location->name}}</h3>
                <p>Città: {{$location->city}}</p>
                <p>Data ed ora attuali: {{$data_ora}}</p>
                <p>Temperatura attuale: {{$current_weather->temperature}} °C</p>
            </div>
            
            <div id="canvas">
                <canvas id="temperatureChart"></canvas>
            </div>
        </div>
    </main>

    <script>
        // Dati passati dal controller
        const labels = @json($hours); // Ore
        const data = @json($temperatures); // Temperature

        // Indici delle linee verticali (separa i giorni)
        const daySeparators = [12,24];

        // Plugin per linee verticali
        const verticalLinePlugin = {
            id: 'verticalLines',
            afterDraw(chart) {
                const ctx = chart.ctx;
                const xAxis = chart.scales.x;
                const chartArea = chart.chartArea;

                ctx.save();
                ctx.strokeStyle = 'rgba(255, 99, 132, 0.8)';
                ctx.lineWidth = 1.5;

                daySeparators.forEach(index => {
                    if (index < xAxis.ticks.length) {
                        const x = xAxis.getPixelForTick(index);

                        ctx.beginPath();
                        ctx.moveTo(x, chartArea.top);
                        ctx.lineTo(x, chartArea.bottom);
                        ctx.stroke();
                    }
                });

                ctx.restore();
            }
        };

        // Configurazione del grafico
        const config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Temperatura (°C)',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Ora'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Temperatura (°C)'
                        }
                    }
                }
            },
            plugins: [verticalLinePlugin]
        };

        // Creazione del grafico
        new Chart(
            document.getElementById('temperatureChart'),
            config
        );
    </script>
</body>
</html>