const initEChart = (selector) => echarts.init(document.querySelector(selector));

const eChart = (selector, option) => {
    const chart = initEChart(selector);

    chart.setOption(option);

    return chart;
};

const setTitle = (title, option) => {
    if (title) option.title = { text: title };
}

const lineSeries = (data, name = '', smooth = true) => {
    return {
        data,
        type: 'line',
        smooth,
        name
    };
};

const doughnutSeries = (name, data) => {
    return {
        name, type: 'pie', radius: ['40%', '70%'], avoidLabelOverlap: false,
        itemStyle: { borderRadius: 10, borderColor: '#fff', borderWidth: 2 },
        data,
    };
};

const barSeries = () => {};

const lineChart = (selector, xData, series, title = null, colors = [], showTooltip = true, gridOptions = {}, showDataLabels = false) => {

    const option = {
        xAxis: { type: 'category', data: xData ,
            axisLabel: {
                formatter: (value) => value,
            }},
        yAxis: { type: 'value' },
        grid: {
            left: gridOptions.left || '3%',
            right: gridOptions.right || '4%',
            bottom: gridOptions.bottom || '3%',
            containLabel: true
        },
        series: series.map((s, index) => ({
            ...s,
            itemStyle: {
                color: colors[index] || undefined
            },
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

    setTitle(title, option);

    return eChart(selector, option);
};


const doughnutChart = (selector, series, title=null) => {
    const option = {
        tooltip: { trigger: 'item' },
        legend: { top: '5%', left: 'center' },
        series
    };

    setTitle(title, option);

    return eChart(selector, option);
};

function formatData(data) {
    return data.map(item => ({
        value: item.total,
        name: item.title
    }));
}

