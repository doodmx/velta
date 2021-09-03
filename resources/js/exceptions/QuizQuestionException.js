import {Exception} from "./Exception";

export class QuizQuestionException extends Exception {

    constructor(message, details) {
        super(message);
        this.name = 'Preguntas';
    }
}
