require('./open.jivochat');
import {jarallax} from 'jarallax';
import Vimeo from "@vimeo/player";
import loadAssets from '../helpers/lazy_loading';
import renderDeviceByBreakpoint from '../helpers/render.devices';


window.addEventListener("resize", function () {

    renderDeviceByBreakpoint('.project-video');
});

window.addEventListener('load', function () {
    renderDeviceByBreakpoint('.project-video');
});


let player = null;
$(function () {


    /* ----- INIT COMPONENTS ----- */
    loadAssets('iframe');
    loadAssets('img');

    jarallax(document.querySelectorAll('.jarallax'), {
        speed: 0.2
    });

    let isPlaying = false;
    const videoContainer = document.getElementById('video');
    player = new Vimeo(videoContainer, {
        controls: false,
        id: 436534581
    });


    /*----- EVENTS ----- */


    $('.play-control').on('click', function () {


        const playButton = $(this);
        const deviceWidth = window.innerWidth;
        const videoContainer = $('#video');

        isPlaying = !isPlaying;

        $('.device-frame img').toggleClass('d-none');
        playButton.toggleClass('active');
        videoContainer.toggleClass('device-content');
        videoContainer.children('iframe').toggleClass('active');

        if (deviceWidth > 1200) {
            $('.video-caption').toggleClass('inactive');
        }


        if (isPlaying) {

            player.play();
            playButton.children('i').removeClass('fa-play').addClass('fa-pause');

            return false;
        }

        playButton.children('i').removeClass('fa-pause').addClass('fa-play');


        player.pause();


    });
});

