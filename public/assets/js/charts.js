const charts = [];

const initChart = (chartId, option) => {
    const chart = echarts.init(document.getElementById(chartId));
    chart.setOption(option);
    charts.push(chart);
    return chart;
};

const updateChart = (chart, option) => {
    chart.setOption(option, true);
};

const setTitle = (option, title) => {
    if (title) {
        option.title = {text: title};
    }
};

const lineOption = (
    xData,
    series,
    min = 0,
    max = 100,
    title = null,
    gridOptions = {},
    showTooltip = true,
    showDataLabels = false
) => {
    const option = {
        xAxis: {
            type: "category",
            data: xData,
            axisLabel: {formatter: (value) => value},
        },
        yAxis: {
            type: "value",
            axisLabel: {formatter: (value) => value},
        },
        legend: {
            show: true,
        },
        grid: {
            left: gridOptions.left || "3%",
            right: gridOptions.right || "4%",
            bottom: gridOptions.bottom || "3%",
            containLabel: true,
        },
        series: series.map((s) => ({
            ...s,
            min,
            max,
            label: {
                show: showDataLabels,
                position: "top",
            },
        })),
        tooltip: showTooltip
            ? {
                trigger: "axis",
                axisPointer: {
                    type: "cross",
                },
            }
            : null,
    };

    setTitle(option, title);
    return option;
};

const barOption = (
    xData,
    series,
    title = null,
    gridOptions = {},
    showTooltip = true,
    showDataLabels = false
) => {
    const option = {
        xAxis: {
            type: "category",
            data: xData,
            axisLabel: {formatter: (value) => value},
        },
        yAxis: {
            type: "value",
            axisLabel: {formatter: (value) => value},
        },
        legend: {
            show: true,
        },
        grid: {
            left: gridOptions.left || "3%",
            right: gridOptions.right || "4%",
            bottom: gridOptions.bottom || "3%",
            containLabel: true,
        },
        series: series.map((s) => ({
            ...s,
            type: "bar",
            label: {
                show: showDataLabels,
                position: "top",
            },
        })),
        tooltip: showTooltip
            ? {
                trigger: "axis",
                axisPointer: {
                    type: "shadow",
                },
            }
            : null,
    };

    setTitle(option, title);
    return option;
};

const doughnutOption = (name, seriesData, title = null) => {
    const option = {
        tooltip: {
            trigger: "item",
            formatter: function (params) {
                return `
                    <div style="font-weight: bold;">Energy Distribution</div>
                    ${params.name}: <strong>${params.value}</strong> kWh (${params.percent}%)
                `;
            },
        },
        legend: {
            show: false,
            top: "5%",
            left: "center",
        },
        series: [
            {
                name,
                type: "pie",
                radius: ["40%", "70%"],
                avoidLabelOverlap: false,
                label: {
                    show: true,
                    position: "outside",
                    formatter: "{b}",
                    alignTo: "labelLine",
                    padding: [0, 5],
                },
                labelLine: {
                    show: true,
                    length: 15,
                    length2: 10,
                    smooth: true,
                },
                emphasis: {
                    show: false,
                },
                data: seriesData,
            },
        ],
    };

    if (title) {
        option.title = {text: title};
    }
    return option;
};

const gaugeOption = (lightColor, darkColor, value, unit, min = 0, max = 100, splitNumber = 10) => {
    return {
        series: [
            {
                type: 'gauge',
                min,
                max,
                progress: {
                    show: true,
                    width: 12  // Decrease the width of the progress bar
                },
                axisLine: {
                    lineStyle: {
                        width: 12  // Decrease the width of the axis line to match the progress
                    }
                },
                axisTick: {
                    show: false
                },
                splitLine: {
                    length: 10,  // Adjust length of split lines to fit better
                    lineStyle: {
                        width: 2,
                        color: '#999'
                    }
                },
                axisLabel: {
                    distance: -10,  // Adjust distance of labels from the axis
                    color: '#999',
                    fontSize: 10  // Decrease the font size of axis labels
                },
                anchor: {
                    show: true,
                    // showAbove: true,
                    size: 15,  // Decrease the size of the anchor
                    itemStyle: {
                        borderWidth: 6
                    }
                },
                title: {
                    show: false
                },
                detail: {
                    valueAnimation: true,
                    fontSize: 16,
                    offsetCenter: [0, '60%'],
                    formatter: `{value} ${unit}`,
                },
                data: [
                    {
                        value
                    }
                ]
            }
        ]
    };
};

    const resizeChart = () => {
    charts.forEach((chart) => {
        chart.resize();
    });
};

window.addEventListener("resize", resizeChart);
