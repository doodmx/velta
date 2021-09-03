import * as http from './http';
import courseObject from "./course.instance";
import * as vimeo from './actions/player';
import {errorAlert} from "../../../helpers/alerts";
import {setChapterStatus, updateProgressBar, getHashValue} from "./actions/app";
import {CourseException} from "../../../exceptions/CourseException";
import {renderProgressCircle, setChapters, setVimeoPlayer} from "./actions/init";


$(function () {

    setVimeoPlayer();
    //usage
    const chapterId = getHashValue('chapterId');
    setChapters(chapterId);
    renderProgressCircle();

    //Vimeo Player Event Subscribers
    vimeo.onPressPlayButton();
    vimeo.onSelectVideo();
    vimeo.onPlayVideo();
    vimeo.onPreviousVideo();
    vimeo.onNextVideo();
    vimeo.onPauseVideo();
    vimeo.onEndedVideo();


    $('.chapter-done').on('click', async function (e) {


        e.preventDefault();

        let enroll = null;
        const currentChapter = $(this).data('chapter');
        const status = $(this).is(':checked') ? 'done' : 'pendant';

        try {

            if (status === 'done') {
                enroll = await http.markChapterAsDone(currentChapter);
            } else {
                enroll = await http.markChapterAsPendant(currentChapter);
            }

            courseObject.setProgress(enroll.chapter_progress);
            setChapterStatus(currentChapter, status === 'done');
            updateProgressBar();


        } catch (e) {
            if (e instanceof CourseException) {
                errorAlert('Curso', e.message);
            }
        }


    });

});
