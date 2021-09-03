import user from '../user';

export function renderIntlInput(modalType, phoneInput) {

    $(modalType).on('shown.bs.modal', function (e) {


        user.setItiPhone(phoneInput);
        user.itiPhone.setNumber(user.contact.whatsapp);

    });
}

export function destroyIntlInput(modalType) {

    $(modalType).on('hidden.bs.modal', function (e) {
        user.destroyItiPhone();
    });

}


export function setModalSettings(modalType) {

    $(`${modalType} input[name=email]`).val(user.contact.email);
    $(`${modalType} input[name="lastname"]`).val(user.lastname);
    $(`${modalType} input[name="name"]`).val(user.name);
    $(`${modalType} input[name="phone_number"]`).val(user.contact.whatsapp);

    $(`${modalType} .id-card-name`).text(user.contact.id_card);
    $(`${modalType} .proof-residence-name`).text(user.contact.proof_residence);

    $(`${modalType} .id-card-link`).attr('href', user.resourcePath + user.contact.id_card);
    $(`${modalType} .proof-residence-link`).attr('href', user.resourcePath + user.contact.proof_residence);

    $('input,textarea').siblings('label').addClass('active');

    if (modalType === '.profile-modal') {


        const isPartner = user.role === 'Partner';
        if (isPartner) {

            $(`${modalType} input[name=email]`).attr('readonly', true);
            $(`${modalType} select[name="membership"]`)
                .val(user.membership)
                .trigger('change')
                .parents('.md-form')
                .show();


        } else {

            $(`${modalType} input[name=email]`).removeAttr('readonly');
            $(`${modalType} select[name="membership"]`)
                .val('')
                .trigger('change')
                .parents('.md-form')
                .hide();


        }
    }

    $(`${modalType}`).modal('show');


}



