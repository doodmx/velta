import getSlug from "speakingurl";

export default function seoCardListeners(titleInput, descriptionInput) {

    $(titleInput)
        .on('change', function (e) {

            const slug = getSlug(e.target.value);

            $('#txtSeoSlug').val(slug);
            $('#txtSeoTitle').val(e.target.value);

            $('.google-card .post-title').text(e.target.value);
            $('input').siblings('label').addClass('active');

        });

    $(descriptionInput)
        .on('keyup', function (e) {

            $('#txtSeoDescription').text(e.target.value);
            $('.google-card .description').text(e.target.value);

            $('textarea').siblings('label').addClass('active');
        });


    $('#txtSeoSeparator')
        .on('keyup', function (e) {

            $('.google-card .post-separator').text(e.target.value);
            $('input').siblings('label').addClass('active');

        });

    $('#txtSeoTitle')
        .on('keyup', function (e) {

            $('.google-card .post-title').text(e.target.value);
            $('textarea').siblings('label').addClass('active');
        });


    $('#txtSeoDescription')
        .on('keyup', function (e) {

            $('.google-card .description').text(e.target.value);
            $('textarea').siblings('label').addClass('active');
        });

}
