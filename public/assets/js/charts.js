const charts = [];

const initChart = (chartId, option) => {
    const chart = echarts.init(document.getElementById(chartId));
    chart.setOption(option);
    charts.push(chart);
    return chart;
};

const updateChart = (chart, option) => {
    chart.setOption(option);
};

const setTitle = (option, title) => {
    if (title) {
        option.title = { text: title };
    }
};

const lineChartOption = (xData, series, title = null, gridOptions = {}, showTooltip = true, showDataLabels = false) => {
    const option = {
        xAxis: {
            type: 'category',
            data: xData,
            axisLabel: { formatter: (value) => value }
        },
        yAxis: {
            type: 'value',
            axisLabel: { formatter: (value) => value }
        },
        legend: {
            show: true
        },
        grid: {
            left: gridOptions.left || '3%',
            right: gridOptions.right || '4%',
            bottom: gridOptions.bottom || '3%',
            containLabel: true
        },
        series: series.map((s) => ({
            ...s,
            label: {
                show: showDataLabels,
                position: 'top'
            }
        })),
        tooltip: showTooltip ? {
            trigger: 'axis',
            axisPointer: {
                type: 'cross'
            }
        } : null
    };

    setTitle(option, title);
    return option;
};

const barChartOption = (xData, series, title = null, gridOptions = {}, showTooltip = true, showDataLabels = false) => {
    const option = {
        xAxis: {
            type: 'category',
            data: xData,
            axisLabel: { formatter: (value) => value }
        },
        yAxis: {
            type: 'value',
            axisLabel: { formatter: (value) => value }
        },
        legend: {
            show: true,
        },
        grid: {
            left: gridOptions.left || '3%',
            right: gridOptions.right || '4%',
            bottom: gridOptions.bottom || '3%',
            containLabel: true
        },
        series: series.map((s) => ({
            ...s,
            type: 'bar',
            label: {
                show: showDataLabels,
                position: 'top'
            }
        })),
        tooltip: showTooltip ? {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        } : null
    };

    setTitle(option, title);
    return option;
};


const doughnutChartOption = (name, seriesData, title = null) => {
    const option = {
        tooltip: {
            trigger: 'item',
            formatter: function(params) {
                return `
                    <div style="font-weight: bold;">Energy Distribution</div>
                    ${params.name}: <strong>${params.value}</strong> kWh (${params.percent}%)
                `;
            }
        },
        legend: {
            show: false,
            top: '5%',
            left: 'center'
        },
        series: [
            {
                name,
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    show: true,
                    position: 'outside',
                    formatter: '{b}',
                    alignTo: 'labelLine',
                    padding: [0, 5]
                },
                labelLine: {
                    show: true,
                    length: 15,
                    length2: 10,
                    smooth: true
                },
                emphasis: {
                    show: false,
                },
                data: seriesData
            }
        ]
    };


    if (title) {
        option.title = { text: title };
    }
    return option;
};

const gaugeChartOption = (value, name, title = null) => {
    const option = {
        tooltip: {
            formatter: function (params) {
                return `<strong>${params.seriesName}</strong><br/>${params.name}: ${params.value} kWh`;
            }
        },
        series: [
            {
                name: 'Energy Consumption',
                type: 'gauge',
                radius: '90%',
                startAngle: 180,
                endAngle: 0,
                splitNumber: 4,
                min: 0,
                max: 1,
                axisLine: {
                    lineStyle: {
                        width: 15,
                        color: [
                            [0.25, '#4caf50'],
                            [0.75, '#ffeb3b'],
                            [1, '#f44336']
                        ]
                    }
                },
                pointer: {
                    width: 5,
                    length: '80%',
                    itemStyle: {
                        color: '#555',
                        shadowBlur: 3
                    }
                },
                axisTick: {
                    distance: -15,
                    length: 5,
                    lineStyle: {
                        color: '#fff',
                        width: 1
                    }
                },
                splitLine: {
                    distance: -15,
                    length: 8,
                    lineStyle: {
                        color: 'transparent',
                        width: 2
                    }
                },
                axisLabel: {
                    color: '#333',
                    fontSize: 10,
                    distance: -30,
                    formatter: function (value) {
                        return Math.round(value);
                    }
                },
                title: {
                    offsetCenter: [0, '65%'],
                    fontSize: 12,
                    color: '#333',
                    show: false,
                },
                detail: {
                    fontSize: 14,
                    fontWeight: 'bold',
                    formatter: '{value} kWh',
                    color: '#333',
                    offsetCenter: [0, '85%']
                },
                data: [{value, name}],
                animationDuration: 1000,
                animationEasing: 'bounceOut'
            }
        ]
    };

    if (title) {
        option.title = { text: title };
    }
    return option;
};

const resizeChart = () => {
    charts.forEach(chart => {
        chart.resize();
    });
};

window.addEventListener('resize', resizeChart);
