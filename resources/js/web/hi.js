$(function () {

    window.Parsley.setLocale('es');
    $('form').parsley();

    $('#example').DataTable();

    $('form').on('submit', function (e) {

        e.preventDefault();

        console.log('submit');
    });
});
