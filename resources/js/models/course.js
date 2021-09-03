export default class Course {


    constructor(id, title, image, progress, player, selectedChapter, chapters) {

        this.id = id;
        this.title = title;
        this.image = chapters;
        this.player = player;
        this.selectedChapter = selectedChapter;
        this.progress = progress;
        this.chapters = chapters;
    }


    setVideoPlayer(player) {
        this.player = player;
    }

    setProgress(progress) {
        this.progress = progress;
    }

    setSelectedChapter(chapter) {
        this.selectedChapter = chapter;
    }

    setChapters(chapters) {
        this.chapters = chapters;
    }

    getPreviousChapter() {

        const currentChapterIndex = this.chapters.findIndex(chapter => chapter.id === this.selectedChapter.id);
        if (currentChapterIndex > 0) {

            const previousChapter = this.chapters[currentChapterIndex - 1];

            return previousChapter;

        }

        return this.chapters[currentChapterIndex];
    }

    getNextChapter() {
        const totalChapters = this.chapters.length;
        const currentChapterIndex = this.chapters.findIndex(chapter => chapter.id === this.selectedChapter.id);

        if ((currentChapterIndex + 1) < totalChapters) {

            return this.chapters[currentChapterIndex + 1];
        }

        return this.selectedChapter;
    }

    getNextPlayableChapter() {

        let nextChapter;
        const currentChapterIndex = this.chapters.findIndex(chapter => chapter.id === this.selectedChapter.id);
        const isEndOfCourse = currentChapterIndex === this.chapters.length - 1;

        for (let i = currentChapterIndex + 1; i < this.chapters.length; ++i) {

            const chapterIsPendant = this.chapters[i].isDone === false;
            if (chapterIsPendant) {
                nextChapter = this.chapters[i];
                break;
            }
        }

        const playableChapterNotFound = nextChapter === undefined;

        if (playableChapterNotFound) {

            if (isEndOfCourse)
                return this.chapters[currentChapterIndex];

            return this.chapters[currentChapterIndex + 1];
        }


        return nextChapter;

    }

}
