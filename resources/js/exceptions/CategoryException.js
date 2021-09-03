import {Exception} from "./Exception";

export class CategoryException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Categorías';
    }
}
