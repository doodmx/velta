export default class Chapter {


    constructor(id, title, translatedTitle, videoLink, isDone) {

        this.id = id;
        this.title = title;
        this.translated_title = translatedTitle;
        this.videoLink = videoLink;
        this.isDone = isDone;

    }

    setIsDone(isDone) {
        this.isDone = isDone;
    }


}
