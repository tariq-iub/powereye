@extends('layouts.powereye')

@section('content')
    <div class="row gy-3 mb-6 justify-content-between">
        <div class="col-md-9 col-auto">
            <h2 class="mb-2 text-body-emphasis">Real-Time View</h2>
            <h5 class="text-body-tertiary fw-semibold">Here’s what’s going on at your business right now</h5>
        </div>
    </div>

    <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-7 pb-3 border-y">
        <div class="row">
            <div class="col-12 col-md-6">
                <h3>Sensor Data Line Chart</h3>
                <div id="powerLineChart" class="h-auto" style="height: 300px;"></div>
            </div>
            <div class="col-12 col-md-6">
                <h3>Sensor Data Pie Chart</h3>
                <div id="sensorPieChart" class="h-auto" style="height: 320px;"></div>
            </div>
        </div>
    </div>

    <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-7 pb-3 border-y">
        <div class="row">
            <div class="col-12 col-md-6">
                <h3>Sensor Data Line Chart 2</h3>
                <div id="barChart" class="h-auto" style="height: 300px;"></div>
            </div>
            <div class="col-12 col-md-6">
                <h3>Sensor Data Pie Chart 2</h3>
                <div id="doughnutChart" class="h-auto" style="height: 320px;"></div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const sensorData = @json($sensorsData);
            const latestSensorData = @json($latestSensorsData);

            const timestamps = latestSensorData.map(data => data.timestamp).reverse();
            const p1Data = latestSensorData.map(data => data.P1).reverse();
            const p2Data = latestSensorData.map(data => data.P2).reverse();
            const p3Data = latestSensorData.map(data => data.P3).reverse();
            const e1Data = sensorData.map(data => data.E1).reverse();
            const e2Data = sensorData.map(data => data.E2).reverse();
            const e3Data = sensorData.map(data => data.E3).reverse();

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

            // Prepare data for the pie charts
            const siteValues = {};

            // Accumulate values for each site
            sensorData.forEach(data => {
                const siteTitle = data.data_file.site.title; // Get site title
                const value = parseFloat(data.P1.toFixed(2)); // Use P1, P2, or any other relevant field

                // Accumulate the value
                if (siteValues[siteTitle]) {
                    siteValues[siteTitle] += value; // Add to existing value
                } else {
                    siteValues[siteTitle] = value; // Initialize if not exists
                }
            });

            // Convert the accumulated values into pieData format
            var pieData = [];
            for (const site in siteValues) {
                pieData.push({ value: siteValues[site], name: site }); // Create pie data
            }

            // Function to create pie chart
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
                            name: 'Power (kW)',
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

            // Create the first pie chart
            createPieChart(document.getElementById('sensorPieChart'), pieData);

            const energyTotals = {};

            sensorData.forEach(data => {
                const timestamp = data.timestamp; // Use timestamp from sensorData
                const totalEnergy = parseFloat((data.E1 + data.E2 + data.E3).toFixed(2)); // Calculate total energy

                if (energyTotals[timestamp]) {
                    energyTotals[timestamp] += totalEnergy; // Accumulate energy for the same timestamp
                } else {
                    energyTotals[timestamp] = totalEnergy; // Initialize if it doesn't exist
                }
            });

            // Prepare data for the bar chart and reverse the order
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

            const siteEnergy = {};

// Accumulate values for each site
            sensorData.forEach(data => {
                const siteTitle = data.data_file.site.title; // Get site title
                const energy = data.E1 + data.E2 + data.E3; // Sum the energies
                const value = parseFloat(energy.toFixed(2)); // Use total energy value

                // Accumulate the value
                if (siteEnergy[siteTitle]) {
                    siteEnergy[siteTitle] += value; // Add to existing value
                } else {
                    siteEnergy[siteTitle] = value; // Initialize if not exists
                }
            });

// Convert the accumulated values into doughnut chart data format
            const doughnutData = Object.keys(siteEnergy).map((siteTitle, index) => ({
                value: siteEnergy[siteTitle],
                name: siteTitle,
            }));

// Initialize the doughnut chart
            const doughnutChart = echarts.init(document.getElementById('doughnutChart')); // Ensure you have a div with id "doughnutChart"

// Define a color array for different sites
            const colors = ['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#FF8D33', '#33FFD1', '#A133FF', '#FFC733'];

// Set the options for the doughnut chart
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
                        radius: ['40%', '70%'], // Inner and outer radius for the doughnut
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
                        data: doughnutData, // Use the processed doughnut data
                        color: colors, // Set the color for each slice
                    },
                ],
            };

// Set the options and render the chart
            doughnutChart.setOption(option);
        });
    </script>
@endpush
