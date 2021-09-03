import {Exception} from "./Exception";

export class QuestionOptionException extends Exception {

    constructor(message, details) {
        super(message);
        this.name = 'Opciones';
    }
}
