import {Exception} from "./Exception";

export class LeadException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Velta Contacto';
    }
}
