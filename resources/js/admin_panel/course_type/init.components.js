require('smartwizard');

export default function initComponents() {

    $('#frmCourseType').parsley();

    $("#smartwizard").smartWizard({
        theme: 'default',
        lang: {  // Language variables
            previous: 'Anterior',
            next: 'Siguiente'
        }
    }).on('leaveStep', function (e, anchorObject, stepNumber, stepDirection) {

        switch (stepNumber) {
            case 0:
                if (!$("#frmCourseType").parsley().validate({group: 'general'}))
                    return false;
                break;
            case 1:
                if (!$("#frmCourseType").parsley().validate({group: 'seo'}))
                    return false;
                break;

        }

    });


}
