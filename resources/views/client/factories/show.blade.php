@extends('layouts.client')

@section('content')
<div class="pb-5">
    <div class="row g-4">
        <div class="col-12 col-xxl-6">
            <div class="mb-8">
                <h2 class="mb-2">{{ $factory->title }}</h2>
                <h5 class="text-body-tertiary fw-semibold">{{ $factory->address }}</h5>
            </div>

            <div class="row align-items-center g-4">
                <div class="col-3">
                    <div class="d-flex align-items-center">
                        <span class="fa-stack" style="min-height: 46px;min-width: 46px;">
                            <span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-success-light"
                                data-fa-transform="down-4 rotate--10 left-4"></span>
                            <span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-success"
                                data-fa-transform="up-4 right-3 grow-2"></span>
                            <span class="fa-stack-1x fa-solid fa-bolt text-success"
                                data-fa-transform="shrink-2 up-8 right-6"></span>
                        </span>
                        <div class="ms-3">
                            <h4 class="mb-0">{{ $latest_energy ?? 0.00 }} kWh</h4>
                            <p class="text-body-secondary fs-9 mb-0">Total Energy Consumed</p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex align-items-center">
                        <span class="fa-stack" style="min-height: 46px;min-width: 46px;">
                            <span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-warning-light"
                                data-fa-transform="down-4 rotate--10 left-4"></span>
                            <span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-warning"
                                data-fa-transform="up-4 right-3 grow-2"></span>
                            <span class="fa-stack-1x fa-solid fa-hourglass-half text-warning"
                                data-fa-transform="shrink-2 up-8 right-6"></span>
                        </span>
                        <div class="ms-3">
                            <h4 class="mb-0">{{ $_12h_energy ?? 0.00 }} kWh</h4>
                            <p class="text-body-secondary fs-9 mb-0">Energy consumed in last 12 hours</p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex align-items-center">
                        <span class="fa-stack" style="min-height: 46px;min-width: 46px;">
                            <span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-danger-light"
                                data-fa-transform="down-4 rotate--10 left-4"></span>
                            <span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-danger"
                                data-fa-transform="up-4 right-3 grow-2"></span>
                            <span class="fa-stack-1x fa-solid fa-calendar-week text-danger"
                                data-fa-transform="shrink-2 up-8 right-6"></span>
                        </span>
                        <div class="ms-3">
                            <h4 class="mb-0">{{ $_1w_energy ?? 0.00 }} kWh</h4>
                            <p class="text-body-secondary fs-9 mb-0">Energy consumed in last week</p>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex align-items-center">
                        <span class="fa-stack" style="min-height: 46px;min-width: 46px;">
                            <span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-info"
                                data-fa-transform="down-4 rotate--10 left-4"></span>
                            <span class="fa-solid fa-circle fa-stack-2x stack-circle text-info-light"
                                data-fa-transform="up-4 right-3 grow-2"></span>
                            <span class="fa-stack-1x fa-solid fa-calendar-alt text-stats-circle-info"
                                data-fa-transform="shrink-2 up-8 right-6"></span>
                        </span>
                        <div class="ms-3">
                            <h4 class="mb-0">{{ $_1m_energy ?? 0.00 }} kWh</h4>
                            <p class="text-body-secondary fs-9 mb-0">Energy consumed in last month</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="bg-body-secondary mb-6 mt-4" />
            <div class="row flex-between-center mb-4 g-3">
                <div class="col-auto">
                    <h3>Energy Usage (kWh)</h3>
                    <p class="text-body-tertiary lh-sm mb-0">Payment received across all channels</p>
                </div>
                <div class="col-8 col-sm-4">
                    <select class="form-select form-select-sm" id="timeframe">
                        @foreach($timeframeOptions as $label => $value)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="factory-chart" style="min-height:320px;width:100%"></div>
        </div>
        <div class="col-12 col-xxl-6">

        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        const factory = @json($factory);
        let currentTimeframe = '1h';
        let chartUpdateInterval;

        document.addEventListener('DOMContentLoaded', async () => {
            const factoryChart = initChart('factory-chart', lineOption([], [{
                name: 'Energy Usage (kWh)',
                data: [],
                type: 'line',
                smooth: true,
            }]));

            const fetchDataAndUpdateChart = async (timeframe) => {
                const data = await fetchData(`factory/${factory.id}/aggregate-sensor-data?timerange=${timeframe}`);

                const timestamp = data.map(dataPoint => dataPoint.timestamp);
                const energy = data.map(dataPoint => dataPoint.total_energy);

                updateChart('factory-chart', lineOption(timestamp, [{
                    data: energy,
                    name: 'Energy Usage (kWh)',
                    type: 'line',
                }]));
            };

            document.getElementById('timeframe').value = '1h';

            await fetchDataAndUpdateChart('1h');

            const startChartUpdates = (timeframe) => {

                if (chartUpdateInterval) {
                    clearInterval(chartUpdateInterval);
                }

                chartUpdateInterval = setInterval(() => {
                    fetchDataAndUpdateChart(timeframe);
                }, 30000);
            };

            startChartUpdates('1h');

            document.getElementById('timeframe').addEventListener('change', async (e) => {
                const newTimeframe = e.target.value;
                currentTimeframe = newTimeframe;

                await fetchDataAndUpdateChart(newTimeframe);

                startChartUpdates(newTimeframe);
            });
        });
    </script>
@endpush
