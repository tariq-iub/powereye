function initEChart(selector: String) {
    return echarts.init(document.querySelector(selector));
}

function lineChart(selector: String, data: Array<{ title: String, value: Number }>, title: String) {
    const chart = initEChart(selector);

    const option = {
        title: {
            text: title
        }
    };

    chart.setOption(option);

    return chart;
}

function doughnutChart(
    selector: string,
    data: Array<{ title: string, value: number }>,
    title: string,
    name: string
): echarts.ECharts {
    const chart = initEChart(selector);

    const option = {
        title: { text: title },
        tooltip: { trigger: 'item' },
        legend: { top: '5%', left: 'center' },
        series: [
            {
                name,
                type: 'pie',
                radius: ['40%', '70%'],
                avoidLabelOverlap: false,
                itemStyle: {
                    borderRadius: 10,
                    borderColor: '#ffffff',
                    borderWidth: 2,
                },
                label: { show: false, position: 'center' },
                emphasis: { label: { show: true, fontSize: 30, fontWeight: 'bold' } },
                labelLine: { show: false },
                data,
            }
        ],
    };

    chart.setOption(option);

    return chart;
}

