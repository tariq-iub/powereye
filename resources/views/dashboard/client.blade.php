@extends('layouts.client')

@push('css')
    <style>
        .chart {
            width: 100%;
        }

        .factory-chart {
            height: 200px;
        }

        .site-chart {
            width: 125px;
            height: 125px;
            position: relative;
        }
    </style>
@endpush

@section('content')
    @if($factories->count() > 0)
        @foreach($factories as $factory)
            @php
                $hasSites = $factory->sites->count() > 0;
            @endphp

            <div class="mx-n4 px-4 py-3 mx-lg-n6 px-lg-6 bg-body-emphasis border-top">

                <div class="row align-items-center">
                    <div class="col-2 col-md-1 d-flex align-items-center justify-content-center p-2">
                        <img
                            src="https://imgs.search.brave.com/SusKZ3EBBMQidIwheCCF_lnece2VYmF2BX3XJxkRUUU/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9icmFu/ZGxvZ292ZWN0b3Iu/Y29tL3dwLWNvbnRl/bnQvdXBsb2Fkcy8y/MDIyLzA2L0lVQi1M/b2dvLnBuZw"
                            alt="{{ $factory->title }}'s logo"
                            class="rounded-circle border object-fit-cover w-100 h-100 w-md-70 h-md-70"
                        >
                    </div>
                    <div class="col-10 col-md-11">
                        <div class="row">
                            <h3 class="col">
                                {{ $factory->title }}
                            </h3>
                            <div
                                class="d-none d-md-flex col-md-4 col-lg-3 w-max-content my-0 badge badge-phoenix fs-10 fs-md-9 badge-phoenix-warning d-flex align-items-center justify-content-center">
                            <span class="fw-bold">
                                Total Power: <span>{{ $factory->totalPower }}</span> kW
                            </span>
                            </div>
                            <div
                                class="d-none d-md-flex col-md-4 col-lg-3 w-max-content my-0 ms-md-2 badge badge-phoenix fs-10 fs-md-9 badge-phoenix-success d-flex align-items-center justify-content-center">
                            <span class="fw-bold">
                                Total Energy: <span>{{ $factory->totalEnergy }}</span> kWh
                            </span>
                            </div>
                        </div>
                        <p class="text-body-tertiary mb-2 m-md-0 mt-md-2 lh-sm">{{ $factory->address }}</p>
                        <div
                            class="d-block d-md-none col-12 w-max-content my-0 badge badge-phoenix fs-10 fs-md-9 badge-phoenix-warning d-flex align-items-center justify-content-center">
                        <span class="fw-bold">
                            Total Power: <span>{{ $factory->totalPower }}</span> kW
                        </span>
                        </div>
                        <div
                            class="d-block d-md-none col-12 w-max-content mt-1 badge badge-phoenix fs-10 fs-md-9 badge-phoenix-success d-flex align-items-center justify-content-center">
                        <span class="fw-bold">
                            Total Energy: <span>{{ $factory->totalEnergy }}</span> kWh
                        </span>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col row justify-content-center justify-content-md-start">
                        @foreach($factory->sites as $site)
                            @php
                                $hasData = $site->totalPower > 0 && $site->totalEnergy > 0;
                            @endphp

                            <div class="{{ $hasSites ? '' : 'd-none' }} site-card-{{ $site->id }} col-12 col-md-6 pb-3">
                                <div class="card h-100 shadow border rounded">
                                    <div
                                        class="pb-2 card-header border-0 d-flex justify-content-between align-items-start">
                                        <h4 class="mb-0">
                                            <a {{ $hasData ? 'href=' . route('sites.show', $site->id) : '' }} class="{{ $hasData ? '' : 'disabled' }} text-decoration-none">
                                                {{ $site->title }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="card-body row py-1">
                                        <div class="{{ $hasData ? "d-none": "" }}">
                                            <div class="alert alert-warning" role="alert">
                                                No data available for this site.
                                            </div>
                                        </div>

                                        <div
                                            class="{{ $hasData ? "": "d-none" }} pt-3 col d-flex flex-column justify-content-between">
                                            <div>
                                                <h6 class="mb-2 text-secondary">
                                                    Power: <strong class="text-dark">
                                                        <span>{{ $site->totalPower }}</span>
                                                        kW</strong>
                                                </h6>
                                                <h6 class="mb-2 text-secondary">
                                                    Energy: <strong class="text-dark">
                                                        <span>{{ $site->totalEnergy }}</span>
                                                        kWh</strong>
                                                </h6>
                                                <h6 class="pt-3 text-secondary">
                                                    Last Updated at:
                                                    <strong>{{ $site->timestamp }}</strong>
                                                </h6>
                                            </div>
                                        </div>
                                        <div
                                            class="{{ $hasData ? '' : 'd-none' }} col d-flex align-items-center justify-content-center m-0 p-0">
                                            <div class="chart site-chart p-0 m-0" id="siteGauge-{{ $site->id }}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="{{ $hasSites ? 'd-none' : '' }} no-site-{{ $site->id }} ms-2">No site to display
                        </div>
                    </div>

                    <div class="vr p-0 bg-body-tertiary d-none d-md-block"></div>

                    <div class="col-12 col-md-4">
                        @php
                            $hasFactoryData = $factory->totalPower > 0 && $factory->totalEnergy > 0;
                        @endphp

                        <div class="{{ $hasFactoryData ? '' : 'd-none' }} line-{{ $factory->id }} row pb-6 pt-2">
                            <div class="col-12 row pb-5">
                                <div class="col">
                                    <h4>Power Usage</h4>
                                </div>
                                <div class="col">
                                    <select class="form-select form-select-sm"
                                            id="factoryLineTimeframe-{{ $factory->id }}">
                                        @foreach($timeframeOptions as $label => $value)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="factoryPowerLine-{{ $factory->id }}" class="chart factory-chart"></div>
                        </div>

                        <div class="{{ $hasFactoryData ? '' : 'd-none' }} dough-{{ $factory->id }} row pb-6">
                            <div class="col-12 row pb-5">
                                <h4>Energy Distribution among sites</h4>
                            </div>
                            <div id="sitesEnergyDough-{{ $factory->id }}" class="chart factory-chart"></div>
                        </div>

                        <div class="{{ $hasFactoryData ? '' : 'd-none' }} bar-{{ $factory->id }} row">
                            <div class="col-12 row pb-5">
                                <div class="col">
                                    <h4>Energy Usage</h4>
                                </div>
                                <div class="col">
                                    <select class="form-select form-select-sm"
                                            id="factoryLineTimeframe-{{ $factory->id }}">
                                        @foreach($timeframeOptions as $label => $value)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="factoryEnergyBar-{{ $factory->id }}" class="chart factory-chart"></div>
                        </div>

                        <div class="{{ $hasFactoryData ? 'd-none' : '' }} no-chart-{{ $factory->id }} ms-2">No data to
                            display
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    @else
        <div>No localities to display</div>
    @endif
@endsection

@push('scripts')
    <script>
        async function log() {
            // const data = await
        }
    </script>
@endpush

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

                const lineChart = initChart(`factoryPowerLine-${factory.id}`, lineOption([], [{
                    name: 'Power Usage (kW)',
                    data: [],
                    type: 'line',
                    smooth: true
                }]));

                const doughnutChart = initChart(`sitesEnergyDough-${factory.id}`, doughnutOption('Energy Distribution', factory.chartData.energyBreakdown.map(entry => ({
                    value: entry.value,
                    name: entry.name
                }))));

                const barChart = initChart(`factoryEnergyBar-${factory.id}`, barOption([], [{
                    data: [1, 2, 3],
                    name: 'Energy Usage (kWh)'
                }]));


                factory.sites.forEach(site => {
                    initChart(`siteGauge-${site.id}`, gaugeOption("#0f0", "#0ff", site.totalEnergy, "kWh"));
                });

                await setupTimeframeSelectors(factory, lineChart, barChart);


                setInterval(async () => {
                    // await updateFactoryAndSiteData(factory, doughnutChart);
                    await updateLineChart(lineChart, factory.id);
                    await updateBarChart(barChart, factory.id);
                }, 6000000);
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


                    // updateSiteTotalsAndCharts(factoryMetrics.sites);


                    const doughnutChartData = factoryMetrics.energyBreakdown.distribution.map(entry => ({
                        value: entry.value,
                        name: entry.name
                    }));
                    updateChart(doughnutChart, doughnutOption('Energy Distribution', doughnutChartData));
                }
            };

            const updateFactoryTotals = (factoryId, totalPower, totalEnergy) => {
                return;
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
                        siteChart.setOption(gaugeOption("#0f0", "#0ff", site.totalEnergy || 0, "kWh"));
                    }
                });
            };

            const updateCharts = (sensorData, chart, chartType, timeframe) => {
                if (sensorData && sensorData.length > 0) {
                    const timestamps = sensorData.map(dataPoint => formatTimestamp(new Date(dataPoint.timestamp), timeframe));
                    const dataField = chartType === 'line' ? 'power' : 'energy';
                    const data = sensorData.map(dataPoint => dataPoint[dataField]);

                    updateChart(chart, chartType === 'line' ? lineOption(timestamps, [{
                        data,
                        name: 'Power Usage (kW)',
                        type: 'line',
                        smooth: true,
                    }]) : barOption(timestamps, [{data, type: 'bar'}]));
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
