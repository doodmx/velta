import * as http from "./http";
import * as alerts from "../../../../helpers/alerts";
import {clearTransactionForm, setModalInvestmentData} from "./actions";
import {TransactionException} from "../../../../exceptions/TransactionException";

const options = { style: 'currency', currency: 'USD' };
export const numberFormat = new Intl.NumberFormat('en-US', options);

$(function () {
    const transactionTable = $('#dataTableBuilder').DataTable();

    $('#openModalCreateTransaction').click(async function () {
        clearTransactionForm();
        setModalInvestmentData();
    });

    $("#selectType").change(async function () {
        $("#frmTransaction").parsley().isValid();
    });

    $("#txtAmount").keyup(async function () {
        $("#frmTransaction").parsley().isValid();
    });

    //On Save
    $("#frmTransaction").on("submit", async function (e) {
        e.preventDefault();
        const formIsValid = $(this).parsley().isValid();

        if (formIsValid) {
            try {
                const type = $('#selectType option:selected').text();
                const amount = $('#txtAmount').val();
                const confirmAction = await alerts.confirmAlert('Movimientos', `¿Esta seguro de realizar el ${type} por ${numberFormat.format(amount)}?`);

                if (confirmAction.value) {
                    const response = await http.save();
                    investment = response.data;
                    transactionTable.ajax.reload();
                    $("#modalCreateTransaction").modal("hide");
                    alerts.successAlert('Transacción', 'Transaccion realizada correctamente');
                }


            } catch (e) {
                if (e instanceof TransactionException) {
                    if (e.validationErrors !== '') {
                        alerts.errorAlert(e.name, e.validationErrors);
                    } else {
                        alerts.errorAlert(e.name, e.message);
                    }
                }
            }
        }
        return false;
    });
});

window.Parsley.addValidator('balance', {
    validateNumber: function (amount) {
        let isValid = true;
        let msg = '';

        const type = $("#selectType").val();
        const balance = parseFloat(investment.balance);
        const profit = parseFloat(investment.profit);
        const withdrawal = parseFloat(investment.withdrawal);
        let total = (profit + balance) - withdrawal;

        let available = investment.status === 'on_progress' ? profit - withdrawal : ( balance + profit ) - withdrawal;

        if (type === 'withdrawal' && amount > available) {
            isValid = false;
            msg = (amount > available) ? 'Saldo insuficiente. Ingresa un importe igual o menor a tu saldo de: ' + numberFormat.format(available) : '';
        }

        $('#errorAmount').html('<ul class="parsley-errors-list filled"><li class="parsley-balance"></li></ul>');
        $('#errorAmount').find('.parsley-balance').html(msg);

        total = type === 'deposit' ? total + amount : total - amount;

        $('#textTotal').text(numberFormat.format(total));

        return isValid;
    },
    requirementType: 'number',
    messages: {
        es: ''
    }
});

