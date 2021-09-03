import {Exception} from "./Exception";

export class CourseException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Cursos';
    }
}
