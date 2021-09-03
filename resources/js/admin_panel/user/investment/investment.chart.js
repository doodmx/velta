import {Chart} from './app'

export default function renderProfitChart(labels, data) {

    new Chart(document.getElementById('profitChart'), {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                backgroundColor: '#FE692E',
                data
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 1000,
                easing: 'linear'
            },
            legend: {
                display: false,
                labels: {
                    fontcolor: 'white'
                }
            },
            tooltips: {
                enabled: true,
                callbacks: {
                    label: function (tooltipItems, data) {
                        return '$' + tooltipItems.yLabel;
                    }
                }
            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        fontColor: 'black',
                    }
                }],
                yAxes: [{
                    display: false
                }]
            }
        }
    });
}
