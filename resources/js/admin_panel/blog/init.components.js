import renderizeWYISYGEditor from "../../helpers/ckeditor";

export default function initComponents() {

    renderizeWYISYGEditor('blogEditor', 400);

    $("#smartwizard").smartWizard({
        theme: 'default',
        lang: {  // Language variables
            previous: 'Anterior',
            next: 'Siguiente'
        }
    }).on('leaveStep', function (e, anchorObject, stepNumber, stepDirection) {

        switch (stepNumber) {
            case 0:
                if (!$("#postForm").parsley().validate({group: 'general'}))
                    return false;
                break;
            case 1:
                if (!$("#postForm").parsley().validate({group: 'article'}))
                    return false;
                break;
            case 2:
                if (!$("#postForm").parsley().validate({group: 'seo'}))
                    return false;
                break;
        }

    });


}
