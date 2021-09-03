import user from "./user";
import {onSubmit} from "./modules/profile";
import {setDocsFileNames} from "./actions";
import * as files from "../../helpers/image_preview";

$(function () {

    $('input[name="photo"]').on('change', function () {
        files.readImageContent(this.files, '#avatarPreview');
    });


    setDocsFileNames();
    user.setId($('#localData').data('user'));
    user.setItiPhone('txtProfileWhatsapp');

    onSubmit();


});
