import {Exception} from "./Exception";

export class PostException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Posts';
    }
}
