$(function () {
    let table = $('#dataTableBuilder').DataTable();
    $("select").materialSelect();

    $('#dataTableBuilder').on('preXhr.dt', function (e, settings, data) {
        data.category = $('#categorySelect').val();
    });

    $("#categorySelect").on("change", function () {
        table.ajax.reload();
    });


});
