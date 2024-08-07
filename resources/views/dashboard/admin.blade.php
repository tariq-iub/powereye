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

            const createTimeSeriesChart = (chart, legends, y) => {
                const lineChart = echarts.init(document.querySelector(chart));
                const lineOption = {
                    tooltip: {
                        trigger: 'axis',
                    },
                    legend: {
                        data: legends
                    },
                    xAxis: {
                        type: 'category',
                        data: formattedTimestamps,
                        axisLabel: {
                            rotate: 30,
                        },
                    },
                    yAxis: {
                        type: 'value',
                        name: y,
                    },
                    series: [
                        {
                            name: `${legends[0]}`,
                            type: 'line',
                            data: p1Data.map(value => parseFloat(value.toFixed(2))),
                            smooth: true,
                        },
                        {
                            name: `${legends[1]}`,
                            type: 'line',
                            data: p2Data.map(value => parseFloat(value.toFixed(2))),
                            smooth: true,
                        },
                        {
                            name: `${legends[2]}`,
                            type: 'line',
                            data: p3Data.map(value => parseFloat(value.toFixed(2))),
                            smooth: true,
                        },
                    ],

                };
                lineChart.setOption(lineOption);
            };

            createTimeSeriesChart('#powerLineChart', ['P1 (W)', 'P2 (W)', 'P3 (W)'], 'Power (W)');


            const pieData = sitesPower.map(site => ({
                value: site.power,
                name: site.title,
            }));

            const createPieChart = (chartDom, pieData) => {
                const pieChart = echarts.init(chartDom);
                const pieOption = {
                    tooltip: {
                        trigger: 'item',
                    },
                    legend: {
                        orient: 'vertical',
                        left: 'left',
                    },
                    series: [
                        {
                            name: 'Power (W)',
                            type: 'pie',
                            radius: ['40%', '70%'],
                            data: pieData,
                            itemStyle:{
                                borderRadius: 10,
                                borderColor: 'transparent',
                                borderWidth: 2,
                            },
                            emphasis: {
                                itemStyle: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)',
                                },
                            },
                        },
                    ],
                };
                pieChart.setOption(pieOption);
            };

            createPieChart(document.getElementById('sensorPieChart'), pieData);

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

            const barChart = echarts.init(document.getElementById('barChart'));
            const option2 = {
                tooltip: { trigger: 'item' },
                legend: { data: ['Energy (kWh)'] },
                xAxis: { type: 'category', data: barData.map(item => item.name) },
                yAxis: { type: 'value', name: 'Energy (kWh)' },
                series: [{
                    name: 'Energy (kWh)',
                    type: 'bar',
                    data: barData.map(item => item.value),
                    emphasis: { focus: 'series' },
                }],
            };

            barChart.setOption(option2);

            const doughnutData = sitesEnergy.map(site => ({
                value: site.energy,
                name: site.title,
            }));

            const doughnutChart = echarts.init(document.getElementById('doughnutChart'));

            const option = {
                tooltip: {
                    trigger: 'item',
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                },
                series: [
                    {
                        name: 'Energy (kWh)',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        itemStyle: {
                            borderRadius: 10,
                            borderColor: 'transparent',
                            borderWidth: 2,
                        },
                        emphasis: {
                            itemStyle: {
                                shadowBlur: 10,
                                shadowOffsetX: 0,
                                shadowColor: 'rgba(0, 0, 0, 0.5)',
                            },
                        },
                        data: doughnutData,
                    },
                ],
            };
            console.log(sitesEnergy);
            doughnutChart.setOption(option);
        });
    </script>
@endpush
