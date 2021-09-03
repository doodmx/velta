import {Chart} from './app';

export default function renderVisitorsChart(visitorsData) {

    const visitorNames = visitorsData.map(visitor => visitor[0]);
    const allVisitors = visitorsData.map(visitor => visitor[1]);
    const newVisitors = visitorsData.map(visitor => visitor[2]);

    new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
            labels: visitorNames,
            datasets: [{
                data: newVisitors,
                label: "Nuevos Visitantes",
                borderColor: "#3e95cd",
                fill: true
            }, {
                data: allVisitors,
                label: "Total visitantes",
                borderColor: "#8e5ea2",
                fill: true
            }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Número de visitas'
            }
        }
    });


}
