import {Exception} from "./Exception";

export class CourseTypeException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Categorías de Cursos';
    }
}
