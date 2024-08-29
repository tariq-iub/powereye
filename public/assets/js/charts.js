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

const lineChartOption = (xData, series, title = null) => {
    const option = {
        tooltip: {
            trigger: 'axis',
            formatter: function(params) {
                let tooltipContent = `${title ? title + '<br/>' : ''}`;
                params.forEach(item => {
                    tooltipContent += `${item.name}: ${item.value}<br/>`;
                });
                return tooltipContent;
            }
        },
        xAxis: { type: 'category', data: xData },
        yAxis: { type: 'value' },
        series
    };
    setTitle(option, title);
    return option;
};

const barChartOption = (xData, series, title = null) => {
    const option = {
        xAxis: { type: 'category', data: xData },
        yAxis: { type: 'value' },
        series: series.map(s => ({ ...s, type: 'bar' }))
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
                    ${params.name}: ${params.value} kWh (${params.percent}%)
                `;
            }
        },
        legend: {
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
                    show: false,
                    position: 'center'
                },
                emphasis: {
                    show: false,
                },
                labelLine: {
                    show: false
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
            formatter: '{a} <br/>{b} : {c} kWh'
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
                        color: 'auto',
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
