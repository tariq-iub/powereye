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

        .vr {
            margin-left: 15px;
            margin-right: 15px;
        }
    </style>
@endpush

@section('content')
@forelse($factories as $factory)
    <div class="mx-n4 px-4 py-3 mx-lg-n6 bg-body-emphasis border-top">
        <div class="row align-items-center">
            <div class="col-2 col-md-1 d-flex align-items-center justify-content-center p-2">
                <img src="https://imgs.search.brave.com/SusKZ3EBBMQidIwheCCF_lnece2VYmF2BX3XJxkRUUU/rs:fit:500:0:0:0/g:ce/aHR0cHM6Ly9icmFu/ZGxvZ292ZWN0b3Iu/Y29tL3dwLWNvbnRl/bnQvdXBsb2Fkcy8y/MDIyLzA2L0lVQi1M/b2dvLnBuZw"
                    alt="{{ $factory->title }}'s logo"
                    class="rounded-circle border object-fit-cover w-100 h-100 w-md-70 h-md-70">
            </div>
            <div class="col-10 col-md-11">
                <div class="row">
                    <h3 class="col">
                        {{ $factory->title }}
                    </h3>
                    <div
                        class="d-none d-md-flex col-md-4 col-lg-3 w-max-content my-0 badge badge-phoenix badge-phoenix-primary fs-10 fs-md-9 d-flex align-items-center justify-content-center">
                        <span class="fw-bold">
                            Total Power: <span id="factoryPower-{{$factory->id}}">{{ $factory->totalPower }}</span> kW
                        </span>
                    </div>
                    <div
                        class="me-3 d-none d-md-flex col-md-4 col-lg-3 w-max-content my-0 ms-md-2 badge badge-phoenix fs-10 fs-md-9 badge-phoenix-success d-flex align-items-center justify-content-center">
                        <span class="fw-bold">
                            Total Energy: <span id="factoryEnergy-{{$factory->id}}">{{ $factory->totalEnergy }}</span> kWh
                        </span>
                    </div>
                </div>
                <p class="text-body-tertiary fs-9 fs-md-8 mb-2 m-md-0 mt-md-2 lh-sm">{{ $factory->address }}</p>
                <div
                    class="d-block d-md-none col-12 w-max-content my-0 badge badge-phoenix badge-phoenix-primary fs-10 fs-md-9 d-flex align-items-center justify-content-center">
                    <span class="fw-bold">
                        Total Power: <span id="factoryPowerSM-{{$factory->id}}">{{ $factory->totalPower }}</span> kW
                    </span>
                </div>
                <div
                    class="d-block d-md-none col-12 w-max-content mt-1 badge badge-phoenix fs-10 fs-md-9 badge-phoenix-success d-flex align-items-center justify-content-center">
                    <span class="fw-bold">
                        Total Energy: <span id="factoryEnergySM-{{$factory->id}}">{{ $factory->totalEnergy }}</span> kWh
                    </span>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            @php
                $hasData = $factory->totalPower > 0;
            @endphp

            <div class="col-12 col-md-8 pe-0 pb-3 pb-md-0 row justify-content-center justify-content-md-start">
                @forelse($factory->sites as $site)
                        @php
                            $hasSiteData = $site->totalPower > 0;
                        @endphp

                        <div class="site-card-{{ $site->id }} col-12 col-md-6 pb-3">
                            <div class="card shadow border rounded pb-4">
                                <div class="pb-2 card-header border-0 d-flex justify-content-between align-items-start">
                                    <h4 class="mb-0">
                                        <a {{ $hasData ? 'href=' . route('sites.show', $site->id) : '' }}
                                            class="{{ $hasData ? '' : 'disabled' }} text-decoration-none">
                                            {{ $site->title }}
                                        </a>
                                    </h4>
                                </div>
                                <div class="card-body row py-1">
                                    <div class="{{ $hasSiteData ? 'd-none' : '' }}" id="no-site-{{$site->id}}">
                                        <div class="mw-100 text-truncate badge badge-phoenix badge-phoenix-warning">
                                            No data available for this site.
                                        </div>
                                    </div>

                                    <div class="{{ $hasSiteData ? '' : 'd-none' }} pt-3 col d-flex flex-column justify-content-between"
                                        id="site-{{$site->id}}">
                                        <div>
                                            <h6 class="mb-2 text-secondary">
                                                Power: <strong class="text-dark">
                                                    <span id="sitePower-{{$site->id}}">{{ $site->totalPower }}</span>
                                                    kW</strong>
                                            </h6>
                                            <h6 class="mb-2 text-secondary">
                                                Energy: <strong class="text-dark">
                                                    <span id="siteEnergy-{{$site->id}}">{{ $site->totalEnergy }}</span>
                                                    kWh</strong>
                                            </h6>
                                            <h6 class="pt-3 text-secondary">
                                                Last Updated at:
                                                <strong id="siteTimestamp-{{$site->id}}">{{ $site->getLastTimestamp() }}</strong>
                                            </h6>
                                        </div>
                                    </div>
                                    <div
                                        class="{{ $hasSiteData ? '' : 'd-none' }} col d-flex align-items-center justify-content-center m-0 p-0">
                                        <div class="chart site-chart p-0 m-0" id="siteGauge-{{ $site->id }}"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @empty
                    <div
                        class="badge badge-phoenix badge-phoenix-warning d-flex align-items-center justify-content-center mx-auto fs-10 fs-md-9 px-3 py-2">
                        No sites available.
                    </div>
                @endforelse
            </div>

            <div class="vr p-0 bg-body-tertiary d-none d-md-block"></div>
            <hr class="d-block d-md-none w-75 mx-auto">

            <div class="col-12 col-md-4">
                @if($hasData)
                    <div class="row pb-6 pt-2">
                        <div class="col-12 row pb-5 pe-0 align-items-center justify-content-between">
                            <div class="col-7">
                                <h4>Power Usage</h4>
                            </div>
                            <div class="col-5 me-0 pe-0">
                                <select class="form-select form-select-sm" id="factoryLineTimeframe-{{ $factory->id }}">
                                    @foreach($timeframeOptions as $label => $value)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="factoryPowerLine-{{ $factory->id }}" class="chart factory-chart"></div>
                    </div>

                    <div class="row pb-6">
                        <div class="col-12 row pb-5 ">
                            <h4>Energy Distribution among sites</h4>
                        </div>
                        <div id="factoryEnergyDough-{{ $factory->id }}" class="chart factory-chart"></div>
                    </div>

                    <div class="row">
                        <div class="col-12 row pe-0 pb-5">
                            <div class="col-7">
                                <h4>Energy Usage</h4>
                            </div>
                            <div class="col-5 me-0 pe-0">
                                <select class="form-select form-select-sm" id="factoryBarTimeframe-{{ $factory->id }}">
                                    @foreach($timeframeOptions as $label => $value)
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="factoryEnergyBar-{{ $factory->id }}" class="chart factory-chart"></div>
                    </div>
                @else
                    <div
                        class="badge badge-phoenix badge-phoenix-warning d-flex align-items-center justify-content-center w-max-content mx-auto fs-10 fs-md-9 px-3 py-2">
                        No data available.
                    </div>
                @endif
            </div>
        </div>
    </div>
@empty
    <div
        class="badge badge-phoenix badge-phoenix-warning d-flex align-items-center justify-content-center w-max-content mx-auto fs-9 fs-md-8 px-3 py-2">
        No localities available.
    </div>
@endforelse
@endsection

@push('scripts')
    <script>
        function isMobileDevice() {
            return window.innerWidth < 768;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const factories = @json($factories);


            factories.forEach(factory => {
                let energyDistribution = [];

                factory.sites.forEach(site => {
                    initChart(
                        `siteGauge-${site.id}`,
                        gaugeOption('Energy', site.lastEnergy, 'kWh')
                    );

                    if (site.totalEnergy > 0) {
                        energyDistribution.push({ name: site.title, value: site.totalEnergy });
                    }
                });

                initFactoryCharts(factory, energyDistribution);

                const lineTimeframeSelect = document.getElementById(`factoryLineTimeframe-${factory.id}`);
                if (lineTimeframeSelect) {
                    lineTimeframeSelect.addEventListener('change', () => {
                        const timeframe = lineTimeframeSelect.value;
                        fetchData(`sensor-data/factory/${factory.id}?startDate=${timeframe}`).then(data => {
                            if (!data) return;
                            const timestamps = data.map(dataPoint => formatTimestamp(new Date(dataPoint.timestamp), timeframe));
                            const powerData = data.map(dataPoint => dataPoint.rolling_average_power);
                            updateChart(`factoryPowerLine-${factory.id}`, lineOption(timestamps, [{ name: 'Power (kW)', data: powerData }]));
                        });
                    });
                }

                const barTimeframeSelect = document.getElementById(`factoryBarTimeframe-${factory.id}`);
                if (barTimeframeSelect) {
                    barTimeframeSelect.addEventListener('change', () => {
                        const timeframe = barTimeframeSelect.value;
                        fetchData(`sensor-data/factory/${factory.id}/energy?startDate=${timeframe}`).then(data => {
                            if (!data) return;
                            const timestamps = data.map(dataPoint => formatTimestamp(new Date(dataPoint.timestamp), timeframe));
                            const energyData = data.map(dataPoint => dataPoint.energy);
                            updateChart(`factoryEnergyBar-${factory.id}`, barOption(timestamps, [{ name: 'Energy (kWh)', data: energyData }]));
                        });
                    });
                }

            });

            setInterval(() => {
                fetch('/api/fetch-factories')
                    .then(response => response.json())
                    .then(data => {
                        const { factories } = data;

                        factories.forEach(factory => {
                            updateFactoryMetrics(factory);
                            let energyDistribution = [];

                            factory.sites.forEach(site => {
                                updateSiteCard(site);

                                if (site.totalEnergy > 0) {
                                    energyDistribution.push({ name: site.title, value: site.totalEnergy });
                                }
                            });

                            if (factory.totalPower > 0) {
                                updateFactoryCharts(factory);
                            }

                        });
                    })
                    .catch(error => {
                        console.error("Error fetching data:", error);
                    });
            }, 300000);
        });

        function updateFactoryCharts(factory) {
            if (factory.totalPower > 0) {
                const lineTimeframeSelect = document.getElementById(`factoryLineTimeframe-${factory.id}`);
                let timeframe = lineTimeframeSelect.value;
                fetchData(`sensor-data/factory/${factory.id}?startDate=${timeframe}`).then(data => {
                    if (!data) return;
                    const timestamps = data.map(dataPoint => formatTimestamp(new Date(dataPoint.timestamp), timeframe));
                    const powerData = data.map(dataPoint => dataPoint.rolling_average_power);
                    updateChart(`factoryPowerLine-${factory.id}`, lineOption(timestamps, [{ name: 'Power (kW)', data: powerData }]));
                });

                const barTimeframeSelect = document.getElementById(`factoryBarTimeframe-${factory.id}`);
                timeframe = barTimeframeSelect.value;

                fetchData(`sensor-data/factory/${factory.id}/energy?startDate=${timeframe}`).then(data => {
                    if (!data) return;
                    const timestamps = data.map(dataPoint => formatTimestamp(new Date(dataPoint.timestamp), timeframe));
                    const energyData = data.map(dataPoint => dataPoint.energy);
                    updateChart(`factoryEnergyBar-${factory.id}`, barOption(timestamps, [{ name: 'Energy (kWh)', data: energyData }]));
                });
            }
        }

        function updateFactoryMetrics(factory) {
            const { id, totalPower, totalEnergy } = factory;

            const SM = isMobileDevice() ? 'SM' : '';

            const factoryPowerSpan = document.getElementById(`factoryPower${SM}-${id}`);
            const factoryEnergySpan = document.getElementById(`factoryEnergy${SM}-${id}`);

            if (factoryPowerSpan && factoryPowerSpan.textContent.trim() !== totalPower.toString().trim()) {
                factoryPowerSpan.textContent = parseFloat(totalPower).toFixed(2);
            }

            if (factoryEnergySpan && factoryEnergySpan.textContent.trim() !== totalEnergy.toString().trim()) {
                factoryEnergySpan.textContent = parseFloat(totalEnergy).toFixed(2);
            }
        }

        function updateSiteCard(site) {
            const { id, totalPower, totalEnergy, lastTimestamp, lastEnergy } = site;

            if (totalPower > 0) {

                const siteCard = document.getElementById(`site-${site.id}`);
                const noSiteCard = document.getElementById(`no-site-${site.id}`)
                const chartId = `siteGauge-${site.id}`;
                const chart = document.getElementById(chartId)

                if (siteCard) siteCard.classList.remove('d-none');
                if (noSiteCard) noSiteCard.classList.add('d-none');
                if (chart) chart.parentElement.classList.remove('d-none');

                const powerSpan = document.getElementById(`sitePower-${id}`);
                const energySpan = document.getElementById(`siteEnergy-${id}`);
                const timestampSpan = document.getElementById(`siteTimestamp-${id}`);

                if (powerSpan && powerSpan.textContent.trim() !== totalPower.toString().trim()) {
                    powerSpan.textContent = parseFloat(totalPower).toFixed(2);
                }

                if (energySpan && energySpan.textContent.trim() !== totalEnergy.toString().trim()) {
                    energySpan.textContent = parseFloat(totalEnergy).toFixed(2);
                }

                if (timestampSpan && timestampSpan.textContent.trim() !== lastTimestamp.toString().trim()) {
                    timestampSpan.textContent = lastTimestamp;
                }

                chart && updateChart(chartId, gaugeOption('Energy', parseFloat(lastEnergy).toFixed(4), 'kWh'));

            }
        }

        function initFactoryCharts(factory, doughnutData) {
            if (factory.totalPower > 0) {
                initChart(`factoryPowerLine-${factory.id}`, lineOption([], [{ name: 'Power (kW)', data: [] }]));
                initChart(`factoryEnergyDough-${factory.id}`, doughnutOption('Energy Distribution', doughnutData));
                initChart(`factoryEnergyBar-${factory.id}`, barOption([], [{ name: 'Energy (kWh)', data: [] }]));

                const timeframe = '1d';

                fetchData(`sensor-data/factory/${factory.id}?startDate=${timeframe}`).then(data => {
                    if (!data) return;
                    const timestamps = data.map(dataPoint => formatTimestamp(new Date(dataPoint.timestamp), timeframe));
                    const powerData = data.map(dataPoint => dataPoint.rolling_average_power);
                    updateChart(`factoryPowerLine-${factory.id}`, lineOption(timestamps, [{ name: 'Power (kW)', data: powerData }]));
                });

                fetchData(`sensor-data/factory/${factory.id}/energy?startDate=${timeframe}`).then(data => {
                    if (!data) return;
                    const timestamps = data.map(dataPoint => formatTimestamp(new Date(dataPoint.timestamp), timeframe));
                    const energyData = data.map(dataPoint => dataPoint.energy);
                    updateChart(`factoryEnergyBar-${factory.id}`, barOption(timestamps, [{ name: 'Energy (kWh)', data: energyData }]));
                });
            }
        }

    </script>
@endpush
