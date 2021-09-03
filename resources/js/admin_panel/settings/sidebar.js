require('../../../mdbpro/4.11.0/js/modules/sidenav.min');

$(function () {


    $(".collapse-left").sideNav();
    $(".collapse-right").sideNav({
        edge: 'right'
    });



    let isOpen = false;
    let $windowWidth = $(window).width();
    const $btnCollapse = $(".collapse-right");
    const $content = $('#content');

    $(window).resize(function () {

        $windowWidth = $(window).width();
        if ($windowWidth > 1440) {
            $content.css('padding-right', '250px');
            if (isOpen) {
                $btnCollapse.css('right', '10');
                isOpen = false;
            }
        } else if ($windowWidth < 530 && isOpen) {
            $btnCollapse.css('right', '10');
            $content.css('padding-right', '0');
            $('#sidenav-overlay').css('display', 'block');
            $btnCollapse.trigger('click');
        } else {
            if (!isOpen) {
                $content.css('padding-right', '10');
            }
        }
    });




    $btnCollapse.on('click', () => {
        isOpen = !isOpen;


        if ($windowWidth > 530) {
            const elPadding = isOpen ? '250px' : '10px';
            $btnCollapse.css('right', elPadding);
            $content.css('padding-right', elPadding);
            $('#sidenav-overlay').css('display', 'none');
        } else {
            $('#sidenav-overlay').on('click', () => {
                isOpen = !isOpen;
            });
        }
    });
    $('#sidenav-overlay').on('click', () => {
        isOpen = !isOpen;
    });


});
