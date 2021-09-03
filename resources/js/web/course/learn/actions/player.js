var $ = require('jquery');
require('jquery-circle-progress');
import {markChapterAsDone} from "../http";
import courseObject from "../course.instance";
import {errorAlert} from "../../../../helpers/alerts";
import {setChapterStatus, updateProgressBar} from "./app";
import {CourseException} from "../../../../exceptions/CourseException";


export function onPressPlayButton() {

    $('.play-control').on('click', function () {
        $('.video-controls').addClass('d-none');
        courseObject.player.play();
    });

}


export function playVideo(chapter) {

    courseObject.setSelectedChapter(chapter);
    courseObject.player.loadVideo(courseObject.selectedChapter.videoLink)
        .then(() => {

            let title = courseObject.selectedChapter.title;

            if (appLocale !== 'es') {
                title = courseObject.selectedChapter.translated_title;
            }
            $('.video-controls .title').text(title);


            setTimeout(() => {
                courseObject.player.play();
            }, 1000);

        })
        .catch((error) => {
            console.log(error);
        });


}

export function onPlayVideo() {
    courseObject.player.on('play', function () {
        $('.video-controls').addClass('d-none');
    });

}

export function onPauseVideo() {
    courseObject.player.on('pause', function () {
        console.log('Player paused');
        $('.video-controls').removeClass('d-none');
    });

}


export function onSelectVideo() {

    $('.chapter-link .description').on('click', function () {
        const chapterId = $(this).data('chapter');
        const selectedChapter = courseObject.chapters.find(chapter => chapter.id === chapterId);

        playVideo(selectedChapter);

    });

}

export function onPreviousVideo() {

    $('.control-prev').on('click', function () {

        const previousChapter = courseObject.getPreviousChapter();
        playVideo(previousChapter);
    });
}

export function onNextVideo() {

    $('.control-next').on('click', function () {

        const nextChapter = courseObject.getNextChapter();
        playVideo(nextChapter);

    });

}

async function playVideoLoader(nextChapter) {

    let step = 1;
    let nextVideoInterval = null;
    const stepPercentage = 0.025;

    const nextVideoLoader = new Promise((resolve, reject) => {

        $('.next-video').removeClass('d-none');
        $('.video-controls').addClass('d-none');
        $('.next-video .title').text(nextChapter.title);

        nextVideoInterval = setInterval(async () => {

            const stepIncrement = step * stepPercentage;
            if (stepIncrement == 1) {
                resolve(true);
            }

            $('.circle').circleProgress('value', stepIncrement);
            step++

        }, 100);
    });


    await nextVideoLoader;

    clearInterval(nextVideoInterval);
    $('.circle').circleProgress('value', 0);
    $('.next-video').addClass('d-none');

}

async function changeChapterOnPlayer(previousChapter, nextChapter) {

    try {

        const enroll = await markChapterAsDone(previousChapter.id);

        courseObject.setProgress(enroll.chapter_progress);
        setChapterStatus(previousChapter.id, true);
        updateProgressBar();
        if (nextChapter !== null) {
            playVideo(nextChapter);
        }


    } catch (e) {
        if (e instanceof CourseException) {
            errorAlert('Curso', e.message);
        }
    }

}


export function onEndedVideo() {

    courseObject.player.on('ended', async function () {


        const currentChapter = courseObject.selectedChapter;
        let nextPlayableChapter = courseObject.getNextPlayableChapter();


        const endOfCourseReached = currentChapter.id === nextPlayableChapter.id;


        if (endOfCourseReached) {
            if (!currentChapter.isDone) {
                await changeChapterOnPlayer(currentChapter, null);
            }
            return false;
        }

        await playVideoLoader(nextPlayableChapter);

        if (!currentChapter.isDone) {
            await changeChapterOnPlayer(currentChapter, nextPlayableChapter);
        }

    });

}
