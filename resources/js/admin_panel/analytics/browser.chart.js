import {Chart} from './app';

export default function renderBrowserChart(browsersData) {


    const browserNames = browsersData.rows.map(browser => `${browser[0]} (${browser[1]})`);
    const browserEntrances = browsersData.rows.map(browser => browser[1]);
    const browserColors = browsersData.rows.map(browser => '#' + Math.floor(Math.random() * 16777215).toString(16));
    const browsersTotal = browsersData.totalsForAllResults['ga:entrances'];


    const pieChartCtx = document.getElementById('browsers').getContext('2d');

    new Chart(pieChartCtx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: browserEntrances,
                backgroundColor: browserColors
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: browserNames
        },
        options: {
            responsive: true,
            aspectRatio: 1,
            title: {
                display: true,
                text: 'Visitas por navegador',
                fontColor: window.colors.secondary_two
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    defaultFontFamily: "'Telegraf','Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
                    fontColor: window.colors.secondary_two
                }
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        const dataset = data.datasets[tooltipItem.datasetIndex];
                        const currentValue = dataset.data[tooltipItem.index];

                        return ((parseFloat(currentValue) * 100) / parseFloat(browsersTotal)).toFixed(2) + '%';
                    }
                }
            }
        }
    });


}
