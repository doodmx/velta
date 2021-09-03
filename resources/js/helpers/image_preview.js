export function readImageContent(files, previewContainer) {

    const filesWereAdded = files.length > 0;

    if (filesWereAdded) {

        const fileReader = new FileReader();
        const image = files[0];

        fileReader.onload = function() { // file is loaded

            var img = new Image;
            img.src = fileReader.result; // is the data URL because called with readAsDataURL

            img.onload = function() {
                $(previewContainer).attr('src', fileReader.result);
                $('#btnClearImage').show();

                let isLightbox = $(previewContainer).parent('a');
                if(isLightbox){
                    isLightbox.attr('href', fileReader.result);
                    isLightbox.attr('data-size', img.width+'x'+img.height);
                }
            };
        };


        fileReader.readAsDataURL(image);
    }
}

export function onRemoveImage(inputFile, previewContainer) {

    $('#btnClearImage').hide();
    const DEFAULT_IMAGE = 'https://cdn.veltacorp.com/img/placeholder.svg';
    $(previewContainer).attr('src', DEFAULT_IMAGE);
    $(inputFile).val('');

}
