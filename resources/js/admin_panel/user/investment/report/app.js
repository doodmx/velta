import * as http from "./http";
import {clearReportForm} from "./actions";
import * as alerts from "../../../../helpers/alerts";
import addFileValidator from "../../../../helpers/file_validator";
import {ReportException} from "../../../../exceptions/ReportException";
import {numberFormat} from "../transaction/app";

$(function () {
    addFileValidator();

    const reportTable = $('#dataTableBuilder').DataTable();
    const parsleyReportForm = $('#frmReport').parsley();

    $('#openModalReport').click(async function () {
        clearReportForm();
        $('#modalReport').modal('show');
    });

    //On Save
    $("#frmReport").on("submit", async function (e) {
        e.preventDefault();

        if (parsleyReportForm.isValid()) {

            try {
                await http.save();
                reportTable.ajax.reload();
                $("#modalReport").modal("hide");
                alerts.successAlert('Reportes', 'Reporte cargado correctamente');
            } catch (e) {
                if (e instanceof ReportException) {
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

    $(document).on('click', '.btn-delete-report', async function (e) {
        e.preventDefault();

        try {
            const confirmAction = await alerts.confirmAlert('Reportes', `¿Esta seguro de eliminar el reporte?`);

            if (confirmAction.value) {
                const reportId = $(this).data('id');
                await http.destroy(reportId);
                reportTable.ajax.reload();
                alerts.successAlert('Reportes', 'Reporte elimiado correctamente.')
            }
        } catch (e) {
            if (e instanceof ReportException) {
                if (e.validationErrors !== '') {
                    alerts.errorAlert(e.name, e.validationErrors);
                } else {
                    alerts.errorAlert(e.name, e.message);
                }
            }
        }
    });
});
