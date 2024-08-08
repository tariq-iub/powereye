@extends('layouts.powereye')

@section('content')
    <div class="row gy-3 mb-6 justify-content-between">
        <div class="col-md-9 col-auto">
            <h2 class="mb-2 text-body-emphasis">Real-Time View</h2>
            <h5 class="text-body-tertiary fw-semibold">Here’s what’s going on at your business right now</h5>

            <form action="" class="w-25">
                <select class="form-select" name="timeframe" onchange="this.form.submit()">
                    @foreach($timeframeOptions as $label => $value)
                        <option value="{{ $value }}" {{ request('timeframe') === $value ? 'selected': '' }}>{{ $label }}</option>
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
                <div id="sensorPieChart" class="h-auto" style="height: 320px;"></div>
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

@endsection

@push('scripts')
    <script>
        const initChart = chart => echarts.init(document.querySelector(chart));

        const seriesObjTS = (name, data, smooth=true) => {
            if (!isNaN(data)) {
                data = data.map(value => parseFloat(value.toFixed(2)));
            }
            return {
                name, type: 'line', data, smooth
            }
        };

        const seriesObjB = (name, data) => {
            data = data.map(item => item.value);
            return {
                name, type: 'bar', data, emphasis: { focus: 'series' },
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
                name, type: 'pie', radius: ['40%', '70%'], data, itemStyle, emphasis
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
        document.addEventListener('DOMContentLoaded', function () {

            const sensorData = @json($sensorsData);
            const sitesPower = @json($sitesPower);
            const sitesEnergy = @json($sitesEnergy);
            const latestSensorData = @json($latestSensorsData);

            const timestamps = latestSensorData.map(data => data.timestamp).reverse();
            const p1Data = latestSensorData.map(data => data.P1).reverse();
            const p2Data = latestSensorData.map(data => data.P2).reverse();
            const p3Data = latestSensorData.map(data => data.P3).reverse();

            const formattedTimestamps = timestamps.map(timestamp =>
                new Date(timestamp).toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true
                })
            );

            createTimeSeriesChart('#powerLineChart', ['P1', 'P2', 'P3'], formattedTimestamps, 'Power', [
                ['P1', p1Data],
                ['P2', p2Data],
                ['P3', p3Data],
            ]);

            const sitesPowerData = sitesPower.map(site => ({
                value: site.power,
                name: site.title,
            }));

            createDoughnutChart('#sensorPieChart', sitesPowerData);

            const energyTotals = {};

            sensorData.forEach(data => {
                const timestamp = data.timestamp;
                const totalEnergy = data.E1 + data.E2 + data.E3;

                if (energyTotals[timestamp]) {
                    energyTotals[timestamp] += totalEnergy;
                } else {
                    energyTotals[timestamp] = totalEnergy;
                }
            });

            const barData = Object.keys(energyTotals).reverse().map(timestamp => ({
                name: new Date(timestamp).toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                }),
                value: energyTotals[timestamp],
            }));

            createBarChart('#barChart', barData ,['Energy (kWh'] ,'Energy', 'Energy');

            const sitesEnergyData = sitesEnergy.map(site => ({
                value: site.energy,
                name: site.title,
            }));

            createDoughnutChart('#doughnutChart', sitesEnergyData);
        });
    </script>
@endpush
