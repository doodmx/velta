export default class User {

    constructor(id, name, lastname, membership, role, contact) {

        this.id = id;
        this.name = name;
        this.lastname = lastname;
        this.membership = membership;
        this.role = role;
        this.resourcePath = '/storage/users/' + this.id + '/';

        this.itiPhone = null;
        this.setContact(contact);
    }


    setId(id) {
        this.id = id;
        this.resourcePath = '/storage/users/' + this.id + '/';
    }

    setName(name) {
        this.name = name;
    }

    setLastName(lastname) {
        this.lastname = lastname;
    }

    setMembership(membership) {
        this.membership = membership;
    }

    setRole(role) {
        this.role = role;
    }

    setContact(contact) {

        //Getting just the filename for idcard and proofResidence
        if (contact.id_card !== null && contact.proof_residence !== null) {

            const proofFileName = contact.proof_residence.split(`users/${this.id}/`);
            const idCardFileName = contact.id_card.split(`users/${this.id}/`);

            contact.proof_residence = proofFileName[1];
            contact.id_card = idCardFileName[1];

        }

        this.contact = contact;
    }

    setItiPhone(phoneInput) {

        const input = document.getElementById(phoneInput);
        const itiPhoneComponent = window.intlTelInput(input, {
            initialCountry: 'MX',
            preferredCountries: ['us', 'gb', 'br', 'ru', 'cn', 'es', 'it'],
            autoPlaceholder: 'aggressive',
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.6/js/utils.js"
        });
        this.itiPhone = itiPhoneComponent;

    }

    destroyItiPhone() {
        this.itiPhone.destroy();

    }
}
