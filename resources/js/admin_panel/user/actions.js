import user from "./user";

export function setUserData(userData) {

    const contact = {
        'email': userData.data('email'),
        'whatsapp': userData.data('whatsapp'),
        'id_card': userData.data('id_card'),
        'proof_residence': userData.data('proof_residence'),
    }


    user.setId(userData.data('id'));
    user.setName(userData.data('name'));
    user.setLastName(userData.data('lastname'));
    user.setMembership(userData.data('membership'));
    user.setRole(userData.data('role'));
    user.setContact(contact);


}

export function setDocsFileNames() {

    $(`input[name=id_card]`).on('change', function () {
        const files = this.files;
        $(`.id-card-name`).text(files[0].name);
    });

    $(`input[name=proof_residence]`).on('change', function () {
        const files = this.files;
        $(`.proof-residence-name`).text(files[0].name);
    });
}
