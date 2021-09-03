import {Exception} from "./Exception";

export class RoleException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Roles';
    }
}
