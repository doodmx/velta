import setConversionStats from "./conversions";
import getAnalyticsStats from "./http";
import * as alerts from '../../helpers/alerts';
import {Exception} from "../../exceptions/Exception";
import renderBrowserChart from "./browser.chart";
import renderVisitorsChart from "./visitors.chart";
import setGeneralStats from "./general.stats";
import {renderPagesChart, setPagesDataTable} from "./pages.stats";


export const Chart = require('chart.js/dist/Chart.bundle.min');
Chart.defaults.global.defaultFontColor = '#424242';
Chart.defaults.global.defaultFontSize = 16;


async function renderWebsiteStats() {

    try {
        const analyticsData = await getAnalyticsStats();
        renderBrowserChart(analyticsData.browsers);
        renderVisitorsChart(analyticsData.visitors.rows);
        setGeneralStats(analyticsData.general.totalsForAllResults);
        setConversionStats(analyticsData.conversions.totalsForAllResults);
        setPagesDataTable(analyticsData.pages.rows);
        renderPagesChart(analyticsData.pagesGraph);

    } catch (e) {
        console.log(e);
        if (e instanceof Exception) {
            alerts.errorAlert(e.title, e.message);
        }
    }
}

$(function () {


    renderWebsiteStats();

    const searchForm = document.getElementById('frmAnalytics');

    searchForm.addEventListener('submit', async function (e) {

        e.preventDefault();
        const isValid = await $('#frmAnalytics').parsley().validate();

        if (isValid) {
            renderWebsiteStats();
        }
    });

});



