export default function setGeneralStats(generalStats) {



    const sessions = document.getElementById('sessions');
    const pagesPerSession = document.getElementById('pagesPerSession');
    const avgSession = document.getElementById('avgSession');
    const newSessions = document.getElementById('newSessions');
    const entrances = document.getElementById('entrances');
    const bounces = document.getElementById('bounces');
    const bouncesPercentage = document.getElementById('bouncesPercentage');
    const entrancesPercentage = document.getElementById('entrancesPercentage');

    sessions.innerText = generalStats['ga:sessions'];
    pagesPerSession.innerText = parseFloat(generalStats['ga:pageviewsPerSession']).toFixed(2);
    avgSession.innerText = parseFloat(generalStats['ga:avgSessionDuration']).toFixed(2) + ' seg';
    newSessions.innerText = parseFloat(generalStats['ga:percentNewSessions']).toFixed(2);
    entrances.innerText = generalStats['ga:entrances'];
    bounces.innerText = generalStats['ga:bounces'];
    bouncesPercentage.innerText = parseFloat(generalStats['ga:bounceRate']).toFixed(2);
    entrancesPercentage.innerText = parseFloat(generalStats['ga:entranceRate']).toFixed(2);

}
