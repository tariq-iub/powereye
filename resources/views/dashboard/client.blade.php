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
        document.addEventListener('DOMContentLoaded', () => {

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

            const initializeFactoryCharts = async (factory) => {

                const lineChart = initChart(`factoryLineChart-${factory.id}`, lineChartOption([], [{
                    name: 'Power Usage (kW)',
                    data: [],
                    type: 'line',
                    smooth: true
                }]));

                const doughnutChart = initChart(`factoryDoughnutChart-${factory.id}`, doughnutChartOption('Energy Distribution', factory.chartData.energyBreakdown.map(entry => ({
                    value: entry.value,
                    name: entry.name
                }))));

                const barChart = initChart(`factoryBarChart-${factory.id}`, barChartOption([], [{
                    data: [],
                    name: 'Energy Usage (kWh)'
                }]));


                factory.sites.forEach(site => {
                    initChart(`siteChart-${site.id}`, gaugeChartOption(site.totalEnergy, site.title));
                });

                await setupTimeframeSelectors(factory, lineChart, barChart);


                setInterval(async () => {
                    await updateFactoryAndSiteData(factory, doughnutChart);
                    await updateLineChart(lineChart, factory.id);
                    await updateBarChart(barChart, factory.id);
                }, 10000);
            };

            const fetchFactoryData = async (factoryId) => {
                try {
                    const response = await fetch(`/api/factoryData/${factoryId}`);
                    return await response.json();
                } catch (error) {
                    console.error('Error fetching factory data:', error);
                }
            };

            const fetchSensorData = async (factoryId, timeframe, chartType) => {
                const uri = chartType === 'line' ? '' : 'energy';
                const url = `sensor-data/factory/${factoryId}/${uri}?startDate=${timeframe}`;
                return await fetchData(url);
            };

            const updateFactoryAndSiteData = async (factory, doughnutChart) => {
                const data = await fetchFactoryData(factory.id);
                if (data) {
                    const {factoryMetrics} = data;


                    updateFactoryTotals(factory.id, factoryMetrics.totalPower, factoryMetrics.totalEnergy);


                    updateSiteTotalsAndCharts(factoryMetrics.sites);


                    const doughnutChartData = factoryMetrics.energyBreakdown.distribution.map(entry => ({
                        value: entry.value,
                        name: entry.name
                    }));
                    updateChart(doughnutChart, doughnutChartOption('Energy Distribution', doughnutChartData));
                }
            };

            const updateFactoryTotals = (factoryId, totalPower, totalEnergy) => {
                const factoryPower = document.getElementById(`factory-power-${factoryId}`);
                const factoryEnergy = document.getElementById(`factory-energy-${factoryId}`);
                animateValue(factoryPower, parseFloat(factoryPower.innerText), totalPower, 1000, 2);
                animateValue(factoryEnergy, parseFloat(factoryEnergy.innerText), totalEnergy, 1000, 2);
            };

            const updateSiteTotalsAndCharts = (sites) => {
                sites.forEach(site => {
                    const siteId = site.siteId;
                    const sitePower = document.getElementById(`site-power-${siteId}`);
                    const siteEnergy = document.getElementById(`site-energy-${siteId}`);
                    const siteChart = echarts.getInstanceByDom(document.getElementById(`siteChart-${siteId}`));


                    animateValue(sitePower, parseFloat(sitePower.innerText), site.totalPower, 1000);
                    animateValue(siteEnergy, parseFloat(siteEnergy.innerText), site.totalEnergy, 1000, 5);


                    if (siteChart) {
                        siteChart.setOption(gaugeChartOption(site.totalEnergy || 0, site.title));
                    }
                });
            };

            const updateCharts = (sensorData, chart, chartType, timeframe) => {
                if (sensorData && sensorData.length > 0) {
                    const timestamps = sensorData.map(dataPoint => formatTimestamp(new Date(dataPoint.timestamp), timeframe));
                    const dataField = chartType === 'line' ? 'power' : 'energy';
                    const data = sensorData.map(dataPoint => dataPoint[dataField]);

                    updateChart(chart, chartType === 'line' ? lineChartOption(timestamps, [{
                        data,
                        name: 'Power Usage (kW)',
                        type: 'line',
                        smooth: true,
                    }]) : barChartOption(timestamps, [{data}]));
                }
            };

            const updateLineChart = async (lineChart, factoryId) => {
                const lineTimeframeSelect = document.getElementById(`factoryLineTimeframe-${factoryId}`);
                const timeframe = lineTimeframeSelect ? lineTimeframeSelect.value : '1d';
                const sensorData = await fetchSensorData(factoryId, timeframe, 'line');
                updateCharts(sensorData, lineChart, 'line', timeframe);
            };

            const updateBarChart = async (barChart, factoryId) => {
                const barTimeframeSelect = document.getElementById(`factoryBarTimeframe-${factoryId}`);
                const timeframe = barTimeframeSelect ? barTimeframeSelect.value : '1d';
                const sensorData = await fetchSensorData(factoryId, timeframe, 'bar');
                updateCharts(sensorData, barChart, 'bar', timeframe);
            };

            const setupTimeframeSelectors = async (factory, lineChart, barChart) => {
                const lineTimeframeSelect = document.getElementById(`factoryLineTimeframe-${factory.id}`);
                const barTimeframeSelect = document.getElementById(`factoryBarTimeframe-${factory.id}`);

                if (lineTimeframeSelect) lineTimeframeSelect.addEventListener('change', () => updateLineChart(lineChart, factory.id));
                if (barTimeframeSelect) barTimeframeSelect.addEventListener('change', () => updateBarChart(barChart, factory.id));

                await updateLineChart(lineChart, factory.id);
                await updateBarChart(barChart, factory.id);
            };

            const factories = @json($factories);
            factories.forEach(factory => initializeFactoryCharts(factory));
        });
    </script>
@endpush
