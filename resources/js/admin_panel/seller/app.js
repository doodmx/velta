$(function () {
    $('.mdb-select').materialSelect();

    $('#dataTableBuilder').on('preXhr.dt', function (e, settings, data) {
        data.course_type = $('#courseTypeSelect').val();
        data.course_status = $('#courseStatus').val();
    });

    $("#courseTypeSelect,#courseStatus").on("change", function () {
        $('#dataTableBuilder').DataTable().ajax.reload();
    });

    $(document).on('click', '.activateCourse', function () {
        const courseId = $(this).data('id');
        const confirmRestoration = confirm('¿Está seguro(a) de reestablecer este curso?');
        if (confirmRestoration) {
            $.simpleAjax({
                type: 'PUT',
                url: `${$('#DATA').data('url')}/courses/${courseId}/restore`,
                loadingSelector: '#dataTableBuilder',
                successCallback() {
                    $('#dataTableBuilder').DataTable().ajax.reload();
                },
                errorCallback() {
                }
            });
        }
    });


    $(document).on('click', '.deactivateCourse', function () {
        const courseId = $(this).data('id');
        const confirmRemoval = confirm('¿Está seguro(a) de eliminar este curso?');
        if (confirmRemoval) {
            $.simpleAjax({
                type: 'DELETE',
                url: `${$('#DATA').data('url')}/courses/${courseId}`,
                loadingSelector: '#dataTableBuilder',
                successCallback() {
                    $('#dataTableBuilder').DataTable().ajax.reload();
                },
                errorCallback() {
                }
            });
        }
    });
});
