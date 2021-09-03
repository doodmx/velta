export default function addFileValidator() {

    window.Parsley
        .addValidator('filemaxmegabytes', {
            requirementType: 'string',
            validateString: function (value, requirement, parsleyInstance) {


                const file = parsleyInstance.$element[0].files;
                const maxBytes = requirement * 1048576;

                if (file.length == 0) {
                    return true;
                }

                return file.length === 1 && file[0].size <= maxBytes;

            },
            messages: {
                en: 'File is to big',
                es: 'Solo se permiten archivos de hasta 2MB'
            }
        })
        .addValidator('filemimetypes', {
            requirementType: 'string',
            validateString: function (value, requirement, parsleyInstance) {


                const file = parsleyInstance.$element[0].files;

                if (file.length == 0) {
                    return true;
                }


                const allowedMimeTypes = requirement.replace(/\s/g, "").split(',');
                console.log(file[0].type);

                return allowedMimeTypes.indexOf(file[0].type) !== -1;

            },
            messages: {
                en: 'File mime type not allowed',
                es: 'Tipo de archivo no permitido'
            }
        });

}
