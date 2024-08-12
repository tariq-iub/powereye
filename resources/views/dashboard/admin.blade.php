@extends('layouts.powereye')

@section('content')
    <div class="row gy-3 mb-6 justify-content-between">
        <div class="col-md-9 col-auto">
            <h2 class="mb-2 text-body-emphasis">Real-Time View</h2>
            <h5 class="text-body-tertiary fw-semibold">Here’s what’s going on at your business right now</h5>

            <form id="timeframe-form" action="" class="w-25">
                <select class="form-select" id="timeframe-select" name="timeframe">
                    @foreach($timeframeOptions as $label => $value)
                        <option value="{{ $value }}" {{ request('timeframe') === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </form>

        </div>
    </div>

    <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-7 pb-3 border-y">
        <div class="row">
            <div class="col-12 col-md-6">
                <h3>Power Consumption</h3>
                <div id="powerLineChart" class="h-auto" style="height: 300px;"></div>
            </div>
            <div class="col-12 col-md-6">
                <h3>Power Consumption of each site</h3>
                <div id="sitesPowerChart" class="h-auto" style="height: 320px;"></div>
            </div>
        </div>
    </div>

    <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-7 pb-3 border-y">
        <div class="row">
            <div class="col-12 col-md-6">
                <h3>Energy Consumption</h3>
                <div id="barChart" class="h-auto" style="height: 300px;"></div>
            </div>
            <div class="col-12 col-md-6">
                <h3>Energy consumption of each site</h3>
                <div id="doughnutChart" class="h-auto" style="height: 320px;"></div>
            </div>
        </div>
    </div>

    <div id="chart" class="h-auto" style="height: 320px;"></div>


@endsection

@push('scripts')
    <script>
        const initChart = chart => echarts.init(document.querySelector(chart));

        const seriesObjTS = (name, data, smooth=true) => {
            if (!isNaN(data)) {
                data = data.map(value => parseFloat(value.toFixed(2)));
            }
            return {
                name, type: 'line', data, smooth, animationDuration: 1000
            }
        };

        const seriesObjB = (name, data) => {
            data = data.map(item => item.value);
            return {
                name, type: 'bar', data, emphasis: { focus: 'series' }, animationDuration: 1000
            }
        };

        const seriesObjD = (name, data, itemStyle=null, emphasis=null) => {
            if (!isNaN(data)) {
                data = data.map(value => parseFloat(value.toFixed(2)));
            }

            if (itemStyle === null) itemStyle = {
                borderRadius: 10,
                borderColor: 'transparent',
                borderWidth: 2,
            };

            if (emphasis === null) emphasis = {
                itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)',
                }
            }

            return {
                name, type: 'pie', radius: ['40%', '70%'], data, itemStyle, emphasis, animationDuration: 1000
            }
        };

        const createTimeSeriesChart = (chart, legends, xData, yLabel, seriesVals) => {
            const timeSeriesChart = initChart(chart);
            const option = {
                tooltip: {
                    trigger: 'axis',
                },
                legend: {
                    data: legends
                },
                xAxis: {
                    type: 'category',
                    data: xData,
                    axisLabel: {
                        rotate: 30,
                    },
                },
                yAxis: {
                    type: 'value',
                    name: yLabel,
                },
                series: seriesVals.map(([name, data, smooth]) => seriesObjTS(name, data, smooth)),
            };
            timeSeriesChart.setOption(option);
        };

        const createDoughnutChart = (chart, data, seriesName) => {
            const doughnutChart = initChart(chart);
            const option = {
                tooltip: {
                    trigger: 'item',
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                },
                series: [seriesObjD(seriesName, data)],
            };

            doughnutChart.setOption(option);
        };

        const createBarChart = (chart, data, legend, yLabel, seriesName) => {
            const barChart = initChart(chart);
            const option = {
                tooltip: { trigger: 'item' },
                legend: { data: legend },
                xAxis: { type: 'category', data: data.map(item => item.name) },
                yAxis: { type: 'value', name: yLabel },
                series: [
                    seriesObjB(seriesName, data)
                ],
            };

            barChart.setOption(option);
        };
    </script>

    <script>
        function updateCharts(data, sitesPower, sitesEnergy) {
            const sitesPowerData = sitesPower.map(site => ({
                value: site.power,
                name: site.title,
            }));

            const sitesEnergyData = sitesEnergy.map(site => ({
                value: site.energy,
                name: site.title,
            }));

            const timestamps = data.map(data => data.timestamp).reverse();
            const pData = data
                .map(data => data.p1 + data.p2 + data.p3)
                .reverse();


            const formattedTimestamps = timestamps.map(timestamp =>
                new Date(timestamp).toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true
                })
            );

            const energyTotals = data.reduce((acc, { timestamp, E1, E2, E3 }) => {
                const totalEnergy = E1 + E2 + E3;
                acc[timestamp] = (acc[timestamp] || 0) + totalEnergy;
                return acc;
            }, {});

            const barData = Object.entries(energyTotals).reverse().map(([timestamp, totalEnergy]) => ({
                name: new Date(timestamp).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true }),
                value: totalEnergy,
            }));

            createTimeSeriesChart('#powerLineChart', ['Total Power'], formattedTimestamps, 'Power', [['Total Power', pData],]);

            createBarChart('#barChart', barData ,['Energy (kWh'] ,'Energy', 'Energy');

            createDoughnutChart('#sitesPowerChart', sitesPowerData, 'Power Consumption by Site');
            createDoughnutChart('#doughnutChart', sitesEnergyData, 'Energy Consumption by Site');
        }

        $(document).ready(function() {
            $('#timeframe-select').on('change', function() {
                const timeframe = $(this).val();
                fetchAndUpdateCharts(timeframe);
            });

            const initialTimeframe = $('#timeframe-select').val();
            fetchAndUpdateCharts(initialTimeframe);

            setInterval(() => fetchAndUpdateCharts(initialTimeframe), 10000);

        });

        function fetchAndUpdateCharts(timeframe) {
            $.when(
                $.ajax({
                    url: '/api/get-sites-power',
                    method: 'GET',
                    data: { timeframe }
                }),
                $.ajax({
                    url: '/api/get-sites-energy',
                    method: 'GET',
                    data: { timeframe }
                }),
                $.ajax({
                    url: '/api/get-sensors-power',
                    method: 'GET',
                    data: { timeframe }
                })
            ).then((powerResponse, energyResponse, sensorsPowerResponse) => {
                const powerData = powerResponse[0];
                const energyData = energyResponse[0];
                const sensorsPower = sensorsPowerResponse[0];
                updateCharts(sensorsPower, powerData, energyData);
            });
        }
    </script>

    <script>
        const chart = echarts.init(document.getElementById('chart'));

        // Initial chart configuration
        const option = {
            title: {
                text: 'Total Power Consumption Over Time'
            },
            tooltip: {
                trigger: 'axis',
                formatter: function (params) {
                    const [param] = params;
                    return `${param.name}<br>Total Power: ${param.value} kWh`;
                }
            },
            xAxis: {
                type: 'category',
                data: [],
                axisLabel: {
                    rotate: 45,
                    interval: 0
                }
            },
            yAxis: {
                type: 'value',
                name: 'Power (kWh)'
            },
            series: [{
                data: [],
                type: 'line',
                name: 'Total Power',
                smooth: true,
                lineStyle: {
                    color: '#ff4500'
                },
                itemStyle: {
                    color: '#ff4500'
                },
                emphasis: {
                    focus: 'series'
                },
                animationDuration: 1000
            }]
        };

        chart.setOption(option);

        function fetchData() {
            fetch('/api/get-factory-power')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Extract data
                    const timeIntervals = data.map(item => item.time_interval);
                    const totalPower = data.map(item => item.total_power);

                    // Update chart
                    chart.setOption({
                        xAxis: {
                            data: timeIntervals
                        },
                        series: [{
                            data: totalPower
                        }]
                    });
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
        }

        fetchData();

        setInterval(fetchData, 10000);
    </script>

    <script src="{{ asset('asset/js/charts.js') }}"></script>

    <script>
         
        doughnutChart('chart', data, 'Doughnut', 'Doughnut')
    </script>

@endpush
