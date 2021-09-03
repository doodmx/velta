import {Exception} from "./Exception";

export class RegisterException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Velta';
    }
}
