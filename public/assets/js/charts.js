const initEChart = (selector) => echarts.init(document.querySelector(selector));

const eChart = (selector, option) => {
    const chart = initEChart(selector);

    chart.setOption(option);

    return chart;
};

const lineSeries = () => {};

const doughnutSeries = (name, data) => {
    return {
        name, type: 'pie', radius: ['40%', '70%'], avoidLabelOverlap: false,
        itemStyle: { borderRadius: 10, borderColor: '#fff', borderWidth: 2 },
        data,
    };
};

const barSeries = () => {};

const doughnutChart = (selector, series, title=null) => {
    const option = {
        tooltip: { trigger: 'item' },
        legend: { top: '5%', left: 'center' },
        series
    };

    if (title) option.title = { text: title };

    return eChart(selector, option);
};

function formatData(data) {
    return data.map(item => ({
        value: item.total,
        name: item.title
    }));
}

