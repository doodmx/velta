import {Exception} from "./Exception";

export class UserException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Usuarios';
    }
}
