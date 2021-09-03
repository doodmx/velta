import {Exception} from "./Exception";

export class ChapterException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Capítulos';
    }
}
