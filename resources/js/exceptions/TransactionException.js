import {Exception} from "./Exception";

export class TransactionException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Transacciones';
    }
}
