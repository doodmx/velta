import '../../helpers/axios';
import {RegisterException} from "../../exceptions/RegisterException";

export async function register(registerData) {
    try {
        return await axios.post(`/leads`,registerData, {'Content-Type': 'multipart/form-data' });
    } catch (e) {
        console.log(e);
        const codeStatus = e.response.status;
        const registerException = new RegisterException('Ocurrio un error al registrar partner, intente más tarde.');

        if (codeStatus === 422) {
            registerException.setValidationErrors(e.response.data.errors.meta);
        }
        throw registerException;
    }
}
