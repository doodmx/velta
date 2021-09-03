import Vimeo from "@vimeo/player";

let player = null;
$(function () {

    let isPlaying = false;
    const videoContainer = document.getElementById('video');
    player = new Vimeo(videoContainer, {
        controls: false,
        id: 429395378
    });

    $('.caption i').on('click', function () {

        isPlaying = !isPlaying;
        $('#video').toggleClass('active');
        $(this).toggleClass('active');
        $('iframe').toggleClass('active');

        if (isPlaying) {

            player.play();
            $(this).removeClass('fa-play').addClass('fa-pause');
            return false;
        }

        $(this).removeClass('fa-pause').addClass('fa-play ');
        player.pause();


    });
});
