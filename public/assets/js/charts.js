function initEChart(selector) {
    return echarts.init(document.querySelector(selector));
}

function lineChart(selector, data, title) {
    const chart = initEChart(selector);

    const option = {
        title: {
            text: title
        }
    };

    chart.setOption(option);

    return chart;
}

function doughnutChart(selector, data, title, name) {
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
                label: { orient: 'vertical', left: 'left', },
                emphasis: { },
                data,
                color: ['#ff7f50', '#87cefa', '#da70d6', '#32c5e9', '#ffbb00', '#ff6e40', '#8a2be2', '#5bc0de', '#d9534f', '#5cb85c'],
            }
        ],
    };

    chart.setOption(option);

    return chart;
}

function fetchData(url, cb) {
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            cb(data, null);
        })
        .catch(error => {
            cb(null, error);
        });
}

fetchData('/api/get-factory-power', (data, error) => {
    if (error) {
        console.log(error);
        return;
    }
    return data;
})
