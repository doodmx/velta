require('./open.jivochat');

import loadAssets from '../helpers/lazy_loading';
import {jarallax} from 'jarallax';


const Profit = function () {
    this.type = "";
};


Profit.prototype = {
    setStrategy: function (type) {
        this.type = type;
    },

    calculate: function (profit, investment) {
        return this.type.calculate(profit, investment);
    }
};

const Yearly = function () {
    this.calculate = function (profit, investment) {

        const annualInvestment = ((parseFloat(investment) * parseFloat(profit.percentage))).toFixed(0);

        return {
            investment: annualInvestment,
            profit: annualInvestment
        };

    }
};

const Monthly = function () {
    this.calculate = function (profit, investment) {

        const annualInvestment = (parseFloat(investment) * parseFloat(profit.percentage)).toFixed(0);
        const annualProfit = (parseFloat(annualInvestment) - parseFloat(investment)).toFixed(0);
        const monthlyProfit = (parseFloat(annualProfit) / 12).toFixed(0);

        return {
            investment: investment,
            profit: monthlyProfit
        };

    }
};


function computeProfit(profits, strategy, type) {

    const yearsLimit = 5;
    const profitObject = new Profit();
    let investment = {
        investment: document.getElementById('initialInvestment').value
    };


    profits.forEach(function (profit, profitIndex) {

        for (let investmentYear = 1; investmentYear <= yearsLimit; ++investmentYear) {


            //Calculate investment by type
            profitObject.setStrategy(strategy);
            investment = profitObject.calculate(profit, investment.investment);


            // Put investment on table results
            const profitByRenderedYear = profit.years.find(year => `${type}-investment${profitIndex + 1}${investmentYear}` === year);
            if (profitByRenderedYear !== undefined) {

                const investmentOnTable = document.getElementById(profitByRenderedYear);
                investmentOnTable.innerText = investment.profit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            }


        }
        investment.investment = document.getElementById('initialInvestment').value;
    });


}


$(function () {

    loadAssets('img');
    jarallax(document.querySelectorAll('.jarallax'), {
        speed: 0.2
    });


    const formCtx = document.getElementById('calculatorForm');


    formCtx.addEventListener('submit', function (event) {

        event.preventDefault();
        const yearlyProfits = [

            {
                percentage: 1.1044,
                years: ['yearly-investment11', 'yearly-investment13', 'yearly-investment15'],
                from: 1,
                to: 2
            },
            {
                percentage: 1.1392,
                years: ['yearly-investment21', 'yearly-investment23', 'yearly-investment25'],
                from: 3,
                to: 4
            },
            {
                percentage: 1.174,
                years: ['yearly-investment31', 'yearly-investment33', 'yearly-investment35'],
                from: 5,
                to: 5
            }


        ];

        const monthlyProfits = [
            {
                percentage: 1.087,
                years: ['monthly-investment11', 'monthly-investment13', 'monthly-investment15'],
                from: 1,
                to: 2
            },
            {
                percentage: 1.116,
                years: ['monthly-investment21', 'monthly-investment23', 'monthly-investment25'],
                from: 3,
                to: 4
            },
            {
                percentage: 1.145,
                years: ['monthly-investment31', 'monthly-investment33', 'monthly-investment35'],
                from: 5,
                to: 5
            }
        ];

        const qtyIsValid = $(this).parsley().isValid();
        if (qtyIsValid) {

            computeProfit(monthlyProfits, new Monthly(), 'monthly');
            computeProfit(yearlyProfits, new Yearly(), 'yearly');

        }

    });
});
