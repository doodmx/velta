import {Exception} from "./Exception";

export class ReportException extends Exception {

    constructor(message) {
        super(message);
        this.name = 'Reportes';
    }
}
