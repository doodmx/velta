
import {numberFormat} from './app';

export function clearTransactionForm() {
    $('#frmTransaction').parsley().reset();
    $("#txtAmount").val('');
}

export function setModalInvestmentData() {
    const balance = parseFloat(investment.balance);
    const profit = parseFloat(investment.profit);
    const withdrawal = parseFloat(investment.withdrawal);


    $("#textBalance").text(numberFormat.format(balance));
    $("#textProfit").text(numberFormat.format(profit));
    $("#textWithdrawal").text(numberFormat.format(withdrawal));

    // const available = parseFloat(investment.profit) - parseFloat(investment.withdrawal);
    const available = investment.status === 'on_progress' ? profit - withdrawal : ( balance + profit ) - withdrawal;
    $("#textAvailable").text(numberFormat.format(available));

    const total = (balance + profit) - withdrawal;
    $("#textTotal").text(numberFormat.format(total));


    $('#modalCreateTransaction').modal('show');
}
