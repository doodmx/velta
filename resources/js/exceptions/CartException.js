import {Exception} from "./Exception";

export class CartException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Carrito';
    }
}
