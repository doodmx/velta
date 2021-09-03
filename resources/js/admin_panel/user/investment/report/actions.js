
export function clearReportForm() {
    $('#frmReport').parsley().reset();
    $("#file").val(null);
    $("#txtReport").val('');
}
