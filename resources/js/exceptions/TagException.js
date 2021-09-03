import {Exception} from "./Exception";

export class TagException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Etiquetas';
    }
}
