$(function () {


    $('.open-chat').on('click', async function () {

        const message = $(this).data('message');


        jivo_api.open({start: 'chat'});

        setTimeout(() => {
            $('.tdTextarea_dda textarea').val(message);

        }, 1000);

    });

});
