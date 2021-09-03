require('smartwizard');

import initComponents from "./init.components";
import seoCardListeners from "../../helpers/seo.card.listeners";

import * as files from '../../helpers/image_preview';
import * as http from './http';
import {PostException} from "../../exceptions/PostException";
import * as alerts from '../../helpers/alerts';


$(function () {


    initComponents();
    seoCardListeners('input[name="blog[title]"]','textarea[name="blog[extract]"]' );

    //----- IMAGE PREVIEW -----
    $('#inputImgThumbnail').on('change', function () {
        files.readImageContent(this.files, '#imgThumbnail,#seoThumbnail');
    });

    $('#btnClearImage').on('click', function () {
        files.onRemoveImage('#inputImgThumbnail', '#imgThumbnail,#seoThumbnail');
    });



    //---- PARSLEY VALIDATION ON COMPONENTS

    $('select').on('change', function () {
        $(this).parsley().validate();
    });


    $(".datepicker").on("changeDate", function () {
        $(this).parsley().validate();

    });

    $("#btnSavePost").on("click", async function (e) {


        const postForm = $('#postForm');
        const postFormIsValid = postForm.parsley().validate();

        if (postFormIsValid) {

            try {

                await http.savePost();
                alerts.successAlert('Posts', 'Publicación guardada correctamente');

            } catch (e) {

                if (e instanceof PostException) {

                    if (e.validationErrors !== '') {
                        alerts.errorAlert(e.name, e.validationErrors);
                    } else {
                        alerts.errorAlert(e.name, e.message);

                    }
                }
            }


        }

    });


});
