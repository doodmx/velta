
import courseObject from '../course.instance';



export function updateProgressBar() {

    $('.progress-bar').css('width', courseObject.progress + '%');
    $('.progress-percentage').text(courseObject.progress + '%');

    const courseIsCompleted = courseObject.progress == 100;
    if (courseIsCompleted) {
        $('.btn-cert').removeClass('d-none');
    } else {
        $('.btn-cert').addClass('d-none');
    }
}


export function setChapterStatus(id, checked) {


    const chapter = courseObject.chapters.find(chapter => chapter.id === id);
    chapter.setIsDone(checked);


    const chapterCheck = $('.chapter-done').filter(`[data-chapter="${chapter.id}"]`);

    if (checked) {
        chapterCheck.attr('checked');
    } else {
        chapterCheck.removeAttr('checked');
    }

    chapterCheck.next().trigger('click');


}

export function getHashValue(key) {
    var matches = location.hash.match(new RegExp(key+'=([^&]*)'));
    return matches ? matches[1] : null;
}
