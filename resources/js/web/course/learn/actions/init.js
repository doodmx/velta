var $ = require('jquery');
import Vimeo from "@vimeo/player";

require('jquery-circle-progress');
import {playVideo} from "./player";
import courseObject from '../course.instance';
import Chapter from "../../../../models/chapter";


export function setVimeoPlayer() {

    const videoContainer = document.querySelector('iframe');
    const player = new Vimeo(videoContainer);

    courseObject.setVideoPlayer(player);

}

export function setChapters(chapterId) {



    const treeChapters = $('#localData').data('chapters');
    let chapters = [];


    treeChapters.forEach(mainChapter => {

        let translatedTitle = null;
        if (appLocale !== 'es') {
            translatedTitle = mainChapter.translated_title[appLocale];
        }

        if (mainChapter.is_done !== undefined) {
            const chapterObject = new Chapter(mainChapter.id, mainChapter.title, translatedTitle, mainChapter.video_link, mainChapter.is_done);
            chapters.push(chapterObject);
        }

        mainChapter.nodes.forEach(node => {

            let translatedTitle = null;
            if (appLocale !== 'es') {
                translatedTitle = node.translated_title[appLocale];
            }

            const nodeObject = new Chapter(node.id, node.title, translatedTitle, node.video_link, node.is_done);
            chapters.push(nodeObject);
        });


    });

    console.log(chapters);

    const chapter = chapters.find(chapter => chapter.id == chapterId);
    const chapterPlay = typeof (chapter) === 'undefined' ? chapters[0] : chapter;
    courseObject.setChapters(chapters);
    playVideo(chapterPlay);
}

export function renderProgressCircle() {

    $('.circle').circleProgress({
        value: 0,
        size: 100,
        fill: '#37D430',
        animation: {
            duration: 50,
            easing: 'circleProgressEasing'
        }
    });

}

