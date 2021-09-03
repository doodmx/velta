import {Exception} from "./Exception";

export class PaymentException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Pagos';
    }
}
