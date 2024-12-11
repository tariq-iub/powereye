@extends('layouts.client')

@push('css')
    <style>
        .chart {
            width: 100%;
        }

        .factory-chart {
            height: 225px;
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
    @php
        $factorySummary = $factory->summary;
        $hasFactorySummary = $factorySummary && true;
        $factoryPower = $factorySummary->power ?? null;
        $factoryEnergy = $factorySummary->energy ?? null;
    @endphp

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
                            Total Power: <span id="factoryPower-{{$factory->id}}">{{ $factoryPower }}</span> kW
                        </span>
                    </div>
                    <div
                        class="me-3 d-none d-md-flex col-md-4 col-lg-3 w-max-content my-0 ms-md-2 badge badge-phoenix fs-10 fs-md-9 badge-phoenix-success d-flex align-items-center justify-content-center">
                        <span class="fw-bold">
                            Total Energy: <span id="factoryEnergy-{{$factory->id}}">{{ $factoryEnergy }}</span> kWh
                        </span>
                    </div>
                </div>
                <p class="text-body-tertiary fs-9 fs-md-8 mb-2 m-md-0 mt-md-2 lh-sm">{{ $factory->address }}</p>
                <div
                    class="d-block d-md-none col-12 w-max-content my-0 badge badge-phoenix badge-phoenix-primary fs-10 fs-md-9 d-flex align-items-center justify-content-center">
                    <span class="fw-bold">
                        Total Power: <span id="factoryPowerSM-{{$factory->id}}">{{ $factoryPower }}</span> kW
                    </span>
                </div>
                <div
                    class="d-block d-md-none col-12 w-max-content mt-1 badge badge-phoenix fs-10 fs-md-9 badge-phoenix-success d-flex align-items-center justify-content-center">
                    <span class="fw-bold">
                        Total Energy: <span id="factoryEnergySM-{{$factory->id}}">{{ $factoryEnergy }}</span> kWh
                    </span>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-12 col-md-8 pe-0 pb-3 pb-md-0 row justify-content-center justify-content-md-start">
                @forelse($factory->sites as $site)
                        @php
                            $siteSummary = $site->summary;
                            $hasSiteSummary = $site->summary && true;
                            $sitePower = $siteSummary->power ?? null;
                            $siteEnergy = $siteSummary->energy ?? null;
                            $siteUpdatedAt = $siteSummary?->updated_at_r;
                        @endphp
                        <div class="site-card-{{ $site->id }} col-12 col-md-6 pb-3">
                            <div class="card shadow border rounded pb-4">
                                <div class="pb-2 card-header border-0 d-flex justify-content-between align-items-start">
                                    <h4 class="mb-0">
                                        <a {{ $hasSiteSummary ? 'href=' . route('sites.show', $site->id) : '' }}
                                            class="{{ $hasSiteSummary ? '' : 'disabled' }} text-decoration-none">
                                            {{ $site->title }}
                                        </a>
                                    </h4>
                                </div>
                                <div class="card-body row py-1">
                                    <div class="{{ $hasSiteSummary ? 'd-none' : '' }}" id="no-site-{{$site->id}}">
                                        <div class="mw-100 text-truncate badge badge-phoenix badge-phoenix-warning">
                                            No data available for this site.
                                        </div>
                                    </div>

                                    <div class="{{ $hasSiteSummary ? '' : 'd-none' }} pt-3 col d-flex flex-column justify-content-between"
                                        id="site-{{$site->id}}">
                                        <div>
                                            <h6 class="mb-2 text-secondary">
                                                Power:
                                                <strong class="text-dark">
                                                    <span id="sitePower-{{$site->id}}">{{ $sitePower }}</span>
                                                    kW
                                                </strong>
                                            </h6>
                                            <h6 class="mb-2 text-secondary">
                                                Energy:
                                                <strong class="text-dark">
                                                    <span id="siteEnergy-{{$site->id}}">{{ $siteEnergy }}</span>
                                                    kWh
                                                </strong>
                                            </h6>
                                            <h6 class="mb-2 text-secondary">
                                                Updated at:
                                                <strong class="text-dark">
                                                    <span id="siteTimestamp-{{$site->id}}">{{ $siteUpdatedAt }}</span>
                                                </strong>
                                            </h6>
                                        </div>
                                    </div>
                                    <div
                                        class="{{ $hasSiteSummary ? '' : 'd-none' }} col d-flex align-items-center justify-content-center m-0 p-0">
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
                @if($hasFactorySummary)
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
                        <div id="factoryPowerDough-{{ $factory->id }}" class="chart factory-chart"></div>
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

            // Initialize charts and setup event listeners for each factory
            factories.forEach(factory => {
                let powerDistribution = [];

                // Initialize site gauges and collect power distribution data
                factory.sites.forEach(site => {
                    if (site.summary) {
                        initChart(
                            `siteGauge-${site.id}`,
                            gaugeOption('Power', site.title, site.summary.power ?? 0, 'kW', 0, 1000)
                        );
                        powerDistribution.push({
                            name: site.title,
                            value: site.summary.power ?? 0
                        });
                    }
                });

                // Initialize factory charts with initial data
                initFactoryCharts(factory, powerDistribution);

                // Setup timeframe change handlers
                setupTimeframeHandlers(factory);
            });

            // Setup periodic data refresh
            setInterval(async () => {
                for (const factory of factories) {
                    try {
                        // Update factory summary data
                        const data = await fetchData(`factory/${factory.id}/summary/latest`);
                        if (!data) continue;

                        updateFactoryMetrics({
                            id: factory.id,
                            totalPower: data.power,
                            totalEnergy: data.energy
                        });

                        // Update site data
                        for (const site of factory.sites) {
                            const siteData = await fetchData(`site/${site.id}/summary/latest`);
                            if (siteData) {
                                updateSiteCard({
                                    site_id: site.id,
                                    total_power: siteData.power,
                                    total_energy: siteData.energy,
                                    updated_at: siteData.updated_at_r
                                });
                            }
                        }

                        // Update factory charts
                        const lineSelect = document.getElementById(`factoryLineTimeframe-${factory.id}`);
                        const barSelect = document.getElementById(`factoryBarTimeframe-${factory.id}`);

                        await fetchAndUpdatePowerChart(factory.id, lineSelect.value);
                        await fetchAndUpdateEnergyChart(factory.id, barSelect.value);

                        // Update power distribution chart
                        const powerDistribution = factory.sites
                            .filter(site => site.summary)
                            .map(site => ({
                                name: site.title,
                                value: site.summary.power ?? 0
                            }));

                        updateChart(
                            `factoryPowerDough-${factory.id}`,
                            doughnutOption('Power Distribution', powerDistribution, factory.sites.length)
                        );

                    } catch (error) {
                        console.error(`Error updating data for factory ${factory.id}:`, error);
                    }
                }
            }, 30000); // Refresh every 30 seconds
        });

        function setupTimeframeHandlers(factory) {
            const lineSelect = document.getElementById(`factoryLineTimeframe-${factory.id}`);
            const barSelect = document.getElementById(`factoryBarTimeframe-${factory.id}`);

            if (lineSelect) {
                lineSelect.addEventListener('change', () => {
                    fetchAndUpdatePowerChart(factory.id, lineSelect.value);
                });
            }

            if (barSelect) {
                barSelect.addEventListener('change', () => {
                    fetchAndUpdateEnergyChart(factory.id, barSelect.value);
                });
            }
        }

        async function fetchAndUpdatePowerChart(factoryId, timeframe) {
            const data = await fetchData(`factory/${factoryId}/aggregate-sensor-data?timerange=${timeframe}`);
            if (!data) return;

            const timestamps = data.map(d => d.timestamp);
            const powerData = data.map(d => d.total_power);

            updateChart(
                `factoryPowerLine-${factoryId}`,
                lineOption(timestamps, [{ name: 'Power (kW)', data: powerData }])
            );
        }

        async function fetchAndUpdateEnergyChart(factoryId, timeframe) {
            const data = await fetchData(`factory/${factoryId}/aggregate-sensor-data?timerange=${timeframe}`);
            if (!data) return;

            const timestamps = data.map(d => d.timestamp);
            const energyData = data.map(d => d.total_energy);

            updateChart(
                `factoryEnergyBar-${factoryId}`,
                barOption(timestamps, [{ name: 'Energy (kWh)', data: energyData }])
            );
        }

        function updateFactoryMetrics(factory) {
            const { id, totalPower, totalEnergy } = factory;
            const SM = isMobileDevice() ? 'SM' : '';

            ['', SM].forEach(suffix => {
                const powerSpan = document.getElementById(`factoryPower${suffix}-${id}`);
                const energySpan = document.getElementById(`factoryEnergy${suffix}-${id}`);

                if (powerSpan) {
                    const currentPower = powerSpan.textContent;
                    const newPower = parseFloat(totalPower).toFixed(2);
                    if (currentPower !== newPower) {
                        powerSpan.textContent = newPower;
                    }
                }
                if (energySpan) {
                    const currentEnergy = energySpan.textContent;
                    const newEnergy = parseFloat(totalEnergy).toFixed(2);
                    if (currentEnergy !== newEnergy) {
                        energySpan.textContent = newEnergy;
                    }
                }
            });
        }

        function updateSiteCard(data) {
            const { site_id: id, total_power: totalPower, total_energy: totalEnergy, updated_at: lastTimestamp } = data;

            const elements = {
                siteCard: document.getElementById(`site-${id}`),
                noSiteCard: document.getElementById(`no-site-${id}`),
                chart: document.getElementById(`siteGauge-${id}`),
                powerSpan: document.getElementById(`sitePower-${id}`),
                energySpan: document.getElementById(`siteEnergy-${id}`),
                timestampSpan: document.getElementById(`siteTimestamp-${id}`)
            };

            if (elements.siteCard) elements.siteCard.classList.remove('d-none');
            if (elements.noSiteCard) elements.noSiteCard.classList.add('d-none');
            if (elements.chart) elements.chart.parentElement.classList.remove('d-none');

            if (elements.powerSpan) {
                const currentPower = elements.powerSpan.textContent;
                const newPower = parseFloat(totalPower).toFixed(2);
                if (currentPower !== newPower) {
                    elements.powerSpan.textContent = newPower;
                }
            }
            if (elements.energySpan) {
                const currentEnergy = elements.energySpan.textContent;
                const newEnergy = parseFloat(totalEnergy).toFixed(2);
                if (currentEnergy !== newEnergy) {
                    elements.energySpan.textContent = newEnergy;
                }
            }
            if (elements.timestampSpan) {
                const currentTimestamp = elements.timestampSpan.textContent;
                if (currentTimestamp !== lastTimestamp) {
                    elements.timestampSpan.textContent = lastTimestamp;
                }
            }

            if (elements.chart) {
                const currentPower = elements.powerSpan?.textContent;
                const newPower = parseFloat(totalPower).toFixed(2);
                if (currentPower !== newPower) {
                    updateChart(
                        `siteGauge-${id}`,
                        gaugeOption('Power', '', totalPower, 'kW', 0, 1000)
                    );
                }
            }
        }

        function initFactoryCharts(factory, doughnutData) {
            if (!factory.summary) return;

            initChart(`factoryPowerLine-${factory.id}`, lineOption([], [{ name: 'Power (kW)', data: [] }]));
            initChart(`factoryPowerDough-${factory.id}`, doughnutOption('Power Distribution', doughnutData, factory.sites.length));
            initChart(`factoryEnergyBar-${factory.id}`, barOption([], [{ name: 'Energy (kWh)', data: [] }]));

            const timeframe = '1h';
            fetchAndUpdatePowerChart(factory.id, timeframe);
            fetchAndUpdateEnergyChart(factory.id, timeframe);
        }
    </script>
@endpush
