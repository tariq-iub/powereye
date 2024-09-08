@extends('layouts.client')

@section('content')
<div class="container-fluid client">
    @foreach($factories as $factory)
    <div class="row py-4 mb-4 border shadow rounded-md factory">
        <div class="col-md-8">
            <div class="row mb-3">
                <div class="d-flex justify-content-between">
                    <h2>{{ $factory->title  }}</h2>
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>
                            <span class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2">
                                <span class="badge-label">
                                    Total Power: <span
                                        id="factory-power-{{$factory->id}}">{{ $factory->totalPower }}</span> kW
                                </span>
                            </span>
                        </h5>
                        <h5>
                            <span class="badge badge-phoenix badge-phoenix-success rounded-pill fs-9 ms-2">
                                <span class="badge-label">
                                    Total Energy: <span
                                        id="factory-energy-{{$factory->id}}">{{ $factory->totalEnergy }}</span> kWh
                                </span>
                            </span>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                @foreach($factory->sites as $site)
                <div class="col-md-4 col-3">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="mb-1 fw-bold">
                                        <a href="{{ route('sites.show', $site->id) }}" class="text-primary">
                                            {{ $site->title }}
                                        </a>
                                    </h5>
                                    <div class="mt-4">
                                        <h6 class="mb-2 text-muted">
                                            Power:
                                            <span class="text-dark fw-bold">
                                                <span
                                                    id="site-power-{{ $site->id }}">{{ $site->totalPower }}</span> kW
                                            </span>
                                        </h6>
                                        <h6 class="text-muted">
                                            Energy:
                                            <span class="text-dark fw-bold">
                                                <span
                                                    id="site-energy-{{ $site->id }}">{{ $site->totalEnergy }}</span> kWh
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                                <div id="siteChart-{{ $site->id }}" class="chart"
                                    style="width:140px; height: 120px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $factory->title }} Power Usage</h5>
                    <div class="col-8 col-sm-4">
                        <select class="form-select form-select-sm" id="factoryLineTimeframe-{{ $factory->id }}">
                            @foreach($timeframeOptions as $label => $value)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div id="factoryLineChart-{{ $factory->id }}" class="chart"
                        style="width: 100%; height: 300px"></div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <h5 class="mb-0">Energy Distribution</h5>
                    <div id="factoryDoughnutChart-{{ $factory->id }}" class="chart"
                        style="width: 100%; height: 250px"></div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $factory->title }} Energy Usage</h5>
                    <div class="col-8 col-sm-4">
                        <select class="form-select form-select-sm" id="factoryBarTimeframe-{{ $factory->id }}">
                            @foreach($timeframeOptions as $label => $value)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-12">
                    <div id="factoryBarChart-{{ $factory->id }}" class="chart"
                        style="width: 100%; height: 250px"></div>
                </div>
            </div>
        </div>

    </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script>
    const initialiseCharts = (factory) => {
        // Initialize line, doughnut, and bar charts
        const lineChart = initChart(`factoryLineChart-${factory.id}`, lineChartOption([], [{
            name: 'Power Usage (kW)',
            data: [],
            type: 'line',
            smooth: true
        }]));
        const doughnutChart = initChart(`factoryDoughnutChart-${factory.id}`, doughnutChartOption('Energy Distribution', []));
        const barChart = initChart(`factoryBarChart-${factory.id}`, barChartOption([], [{
            name: 'Energy Usage (kWh)',
            data: []
        }]));

        // Initialize site charts
        factory.sites.forEach(site => {
            let siteChart = echarts.getInstanceByDom(document.getElementById(`siteChart-${site.id}`));
            if (!siteChart) {
                siteChart = initChart(`siteChart-${site.id}`, gaugeChartOption(0, ''));
            }
        });

        fetchChartData(factory, lineChart, doughnutChart, barChart);

        setInterval(() => {
            fetchChartData(factory, lineChart, doughnutChart, barChart);
        }, 30000);
    };

    const animateValue = (element, start, end, duration, decimals = 2) => {
        let startTime = null;

        const step = (timestamp) => {
            if (!startTime) startTime = timestamp;
            const progress = Math.min((timestamp - startTime) / duration, 1);
            const currentValue = start + (end - start) * progress;

            element.innerText = currentValue % 2 !== 0 ? currentValue.toFixed(decimals) : currentValue;

            if (progress < 1) {
                requestAnimationFrame(step);
            }
        };

        requestAnimationFrame(step);
    };

    const updateFactoryTotals = (data) => {
        const factoryId = data.factory.id;
        const {
            totalPower,
            totalEnergy
        } = data.factoryMetrics;

        const factoryPower = document.getElementById(`factory-power-${factoryId}`);
        const factoryEnergy = document.getElementById(`factory-energy-${factoryId}`);

        const currentPower = parseFloat(factoryPower.innerText);
        const currentEnergy = parseFloat(factoryEnergy.innerText);

        animateValue(factoryPower, currentPower, totalPower, 1000, 2);
        animateValue(factoryEnergy, currentEnergy, totalEnergy, 1000, 8);
    };

    const updateSiteTotalsAndCharts = (data) => {
        data.factoryMetrics.sites.forEach(site => {
            const siteId = site.siteId;
            const sitePower = document.getElementById(`site-power-${siteId}`);
            const siteEnergy = document.getElementById(`site-energy-${siteId}`);
            const siteChartId = document.getElementById(`siteChart-${siteId}`);
            const siteChart = echarts.getInstanceByDom(siteChartId);

            const currentSitePower = parseFloat(sitePower.innerText);
            const currentSiteEnergy = parseFloat(siteEnergy.innerText);

            animateValue(sitePower, currentSitePower, site.totalPower, 1000);
            animateValue(siteEnergy, currentSiteEnergy, site.totalEnergy, 1000, 5);

            if (siteChart) {
                siteChart.setOption(gaugeChartOption(site.totalEnergy || 0, site.title));
            }
        });
    };

    const updateFactoryCharts = (sensorData, energyData, energyBreakdown, lineChart, doughnutChart, barChart) => {
        const lineChartData = {
            timestamp: sensorData.map(entry => entry.timestamp),
            power: sensorData.map(entry => entry.power)
        };

        updateChart(lineChart, lineChartOption(lineChartData.timestamp, [{
            name: 'Power Usage (kW)',
            type: 'line',
            data: lineChartData.power,
            smooth: true
        }]));

        const barChartData = {
            timestamp: energyData.map(entry => entry.timestamp),
            energy: energyData.map(entry => entry.energy)
        };

        updateChart(barChart, barChartOption(barChartData.timestamp, [{
            name: 'Energy Usage (kWh)',
            type: 'bar',
            data: barChartData.energy
        }]));

        const doughnutChartData = energyBreakdown.distribution.map(entry => ({
            value: entry.value,
            name: entry.name
        }));

        updateChart(doughnutChart, doughnutChartOption('Energy Distribution', doughnutChartData));
    };

    const fetchChartData = (factory, lineChart, doughnutChart, barChart) => {
        fetch(`/api/factoryData/${factory.id}`)
            .then(response => response.json())
            .then(data => {
                const {
                    sensorData,
                    energyData,
                    energyBreakdown
                } = data.factoryMetrics;

                console.log(data.factoryMetrics);

                updateFactoryTotals(data);
                updateSiteTotalsAndCharts(data);
                updateFactoryCharts(sensorData, energyData, energyBreakdown, lineChart, doughnutChart, barChart);
            })
            .catch(error => {
                console.error('Error fetching chart data:', error);
            });
    };

    document.addEventListener('DOMContentLoaded', () => {
        const factories = @json($factories);
        factories.forEach(factory => initialiseCharts(factory));
    });
</script>



{{-- <script>--}}
{{-- document.addEventListener('DOMContentLoaded', () => {--}}

{{-- const initializeFactoryCharts = async (factory) => {--}}
{{-- const lineChart = initChart(`factoryLineChart-${factory.id}`, lineChartOption([], [{--}}
{{-- name: 'Power Usage (kW)',--}}
{{-- data: [],--}}
{{-- type: 'line',--}}
{{-- smooth: true--}}
{{-- }]));--}}
{{-- const doughnutChart = initChart(`factoryDoughnutChart-${factory.id}`, doughnutChartOption('Energy', factory.chartData.energyBreakdown));--}}
{{-- const barChart = initChart(`factoryBarChart-${factory.id}`, barChartOption([], [{--}}
{{-- data: [],--}}
{{-- name: 'Energy Usage (kWh)'--}}
{{-- }]));--}}

{{-- factory.sites.forEach(site => {--}}
{{-- const gaugeChart = initChart(`siteGaugeChart-${site.id}`, gaugeChartOption(site.totalEnergy || 0, site.title));--}}
{{-- });--}}

{{-- await setupTimeframeSelectors(factory, lineChart, barChart);--}}
{{-- };--}}

{{-- const fetchChartData = async (factoryId, timeframe, chartType) => {--}}
{{-- const uri = chartType === 'line' ? '' : 'energy';--}}
{{-- const url = `sensor-data/factory/${factoryId}/${uri}?startDate=${timeframe}`;--}}
{{-- return await fetchData(url);--}}
{{-- };--}}

{{-- const updateCharts = (sensorData, chart, chartType, timeframe) => {--}}
{{-- if (sensorData && sensorData.length > 0) {--}}
{{-- console.log(sensorData);--}}
{{-- const timestamps = sensorData.map(dataPoint => formatTimestamp(new Date(dataPoint.timestamp), timeframe));--}}
{{-- const dataField = chartType === 'line' ? 'power' : 'energy';--}}
{{-- const data = sensorData.map(dataPoint => dataPoint[dataField]);--}}
{{-- updateChart(chart, chartType === 'line' ? lineChartOption(timestamps, [{data}]) : barChartOption(timestamps, [{data}]));--}}
{{-- }--}}
{{-- };--}}

{{-- const setupTimeframeSelectors = async (factory, lineChart, barChart) => {--}}
{{-- const lineTimeframeSelect = document.getElementById(`factoryLineTimeframe-${factory.id}`);--}}
{{-- const barTimeframeSelect = document.getElementById(`factoryBarTimeframe-${factory.id}`);--}}

{{-- const updateLineChart = async () => {--}}
{{-- const timeframe = lineTimeframeSelect ? lineTimeframeSelect.value : '1d';--}}
{{-- const sensorData = await fetchChartData(factory.id, timeframe, 'line');--}}
{{-- updateCharts(sensorData, lineChart, 'line', timeframe);--}}
{{-- };--}}

{{-- const updateBarChart = async () => {--}}
{{-- const timeframe = barTimeframeSelect ? barTimeframeSelect.value : '1d';--}}
{{-- const sensorData = await fetchChartData(factory.id, timeframe, 'bar');--}}
{{-- updateCharts(sensorData, barChart, 'bar', timeframe);--}}
{{-- };--}}

{{-- if (lineTimeframeSelect) lineTimeframeSelect.addEventListener('change', updateLineChart);--}}
{{-- if (barTimeframeSelect) barTimeframeSelect.addEventListener('change', updateBarChart);--}}

{{-- await updateLineChart();--}}
{{-- await updateBarChart();--}}

{{-- setInterval(() => {--}}
{{-- updateLineChart();--}}
{{-- updateBarChart();--}}
{{-- }, 10000);--}}
{{-- };--}}

{{-- const factories = @json($factories);--}}
{{-- factories.forEach(factory => initializeFactoryCharts(factory));--}}
{{-- });--}}
{{-- </script>--}}
@endpush