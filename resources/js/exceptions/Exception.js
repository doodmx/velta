export class Exception {

    constructor(message) {
        this.name = 'Error';
        this.message = message;
        this.validationErrors = '';
    }

    setName(name){
        this.name=name;
    }
    setMessage(message) {

        this.message = message;
    }

    setValidationErrors(errors) {

        let htmlError = `
                            <p>${this.name}</p>
                            <div class="container mt-4 text-justify text-red">
                        `;

        if (errors !== undefined) {

            for (const key in errors) {
                htmlError += `
                    <p>
                        <i class="fas fa-caret-right mr-2"></i>${errors[key][0]}
                    </p>`;
            }
            htmlError += '</div>';
        }

        this.validationErrors = htmlError
    }
}
