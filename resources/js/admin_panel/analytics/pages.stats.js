import {Chart} from './app';

export function setPagesDataTable(pagesData) {

    let pagesDatatable = $('#pagesTable').DataTable();

    let pageRows = '';

    pagesData.forEach((pageData) => {

        const entranceRate = parseFloat(pageData[6]).toFixed(2) + '%';
        const bounceRate = parseFloat(pageData[7]).toFixed(2) + '%';
        const avgTimeOnPage = parseFloat(pageData[5] / 60).toFixed(2) + ' min';

        pageRows += `
            <tr>
                <td>${pageData[0]}</td>
                 <td>${pageData[1]}</td>
                <td>${pageData[2]}</td>
                <td>${pageData[3]}</td>
                <td>${pageData[4]}</td>
                <td>${pageData[8]}</td>
                <td>${pageData[9]}</td>
                <td>${entranceRate}</td>
                <td>${bounceRate}</td>
                <td>${avgTimeOnPage}</td>
            </tr>
        `;

    });

    $('#pagesTable tbody').html(pageRows);
    pagesDatatable.clear();

}

export function renderPagesChart(pageGraphRows) {


    const pageChartLabels = pageGraphRows.map((pageGraphRow) => pageGraphRow.page);
    const pageChartEntrances = pageGraphRows.map((pageGraphRow) => pageGraphRow.entrances);
    const pageChartViews = pageGraphRows.map((pageGraphRow) => pageGraphRow.pageviews);

    const pagesBarChart = {
        labels: pageChartLabels,
        datasets: [{
            label: 'Entradas',
            backgroundColor: window.colors.secondary_two,
            data: pageChartEntrances
        }, {
            label: 'Vistas',
            backgroundColor: window.colors.primary,
            data: pageChartViews
        }]

    };


    const pagesGraphCtx = document.getElementById('pagesChart').getContext('2d');
    new Chart(pagesGraphCtx, {
        type: 'bar',
        data: pagesBarChart,
        options: {
            title: {
                display: true,
                text: 'Gráfica de visitas por página'
            },
            tooltips: {
                mode: 'index',
                intersect: false
            },
            responsive: true,
            scales: {
                xAxes: [{
                    stacked: true,
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        }
    });


}
