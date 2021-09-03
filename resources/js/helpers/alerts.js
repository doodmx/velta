export function successAlert(title, message) {
    Swal.fire({
        title: title,
        text: message,
        icon: 'success',
        customClass: {
            confirmButton: 'btn btn-primary white-text',
        },
        buttonsStyling: false
    });
};

export async function confirmAlert(title, message) {

    return await Swal.fire({
        title: title,
        text: message,
        icon: 'question',
        dangerMode: true,
        showCancelButton:true,
        customClass: {
            confirmButton: 'btn  btn-primary white-text',
            cancelButton: 'btn btn-secondary white-text'
        },
        buttonsStyling: false
    });

};


export function errorAlert(title, message) {
    Swal.fire({
        title: title,
        html: message,
        icon: 'error',
        dangerMode: true,
        customClass: {
            confirmButton: 'btn  btn-primary white-text',
        },
        buttonsStyling: false
    });
};
