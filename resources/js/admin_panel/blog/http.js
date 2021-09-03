import '../../helpers/axios';
import {PostException} from "../../exceptions/PostException";

export async function savePost() {


    try {


        const postForm = document.getElementById('postForm');
        const postData = new FormData(postForm);


        await axios.post($("#DATA").data('url') + postForm.dataset.action, postData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });


    } catch (e) {

        const codeStatus = e.response.status;
        const postException = new PostException('Hubo un error al guardar la publicación, intente más tarde.');

        if (codeStatus === 422) {
            postException.setValidationErrors(e.response.data.errors.meta);
        }

        throw postException;
    }


}
