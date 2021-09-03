import moment from 'moment';
import renderProfitChart from './investment.chart';

export const Chart = require('chart.js/dist/Chart.bundle.min');
Chart.defaults.global.defaultFontColor = '#424242';
Chart.defaults.global.defaultFontSize = 16;

$(function () {
   let accumulated = 0;
   let dataChart = [0];
   let labelsChart = [''];

   // const transactions = this.investment.relationships.transactions.filter((transaction) => transaction.data.attributes.type === 'profit');
   transactions.filter((transaction) => transaction.type === 'profit').forEach((transaction) => {
      moment.locale('es');
      const period = moment(transaction.end_date).format('MMM Y');

      accumulated += parseFloat(transaction.amount);
      dataChart.push(accumulated);
      labelsChart.push(period);
   });
   dataChart = dataChart.concat(0);
   labelsChart = labelsChart.concat('');

   renderProfitChart(labelsChart, dataChart);
});
