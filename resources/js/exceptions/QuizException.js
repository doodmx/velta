import {Exception} from "./Exception";

export class QuizException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Cuestionarios';

    }
}
