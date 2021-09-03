const rater = require('rater-js');

const ratingCourse = document.getElementById('rating-course');
if (ratingCourse !== null) {
    const ratingCourseComponent = rater({
        element: ratingCourse,
        starSize: 35,
        step: 0.5,
        showToolTip: true,
        rateCallback: function (rating, done) {
            $('input[name=rate]').val(rating);
            $('input[name=rate]').parsley().validate();
            ratingCourseComponent.setRating(rating);
            done();
        },
        function(error) {
            console.log('error');
        }
    });
}


$(function () {

    window.Parsley.setLocale(appLocale);


    $('#openRateModal').on('click', function () {

        $('#frmReview').attr('action', 'enrolls/' + $(this).data('enroll') + '/review');

        $('#modalCourseTitle').text($(this).data('course'));

        $('#rateModal').modal('show');
    });

    $('#cancelReview').on('click', function () {

        $('#rateModal').modal('hide');
        ratingCourseComponent.setRating(0);
        $('input[name=rate]').val('');

    });


});


const rateElements = document.getElementsByClassName('course-rater');
if (rateElements.length > 0) {
    for (const index in rateElements) {

        let raterComponent = rater({
            element: rateElements[index],
            rateCallback: function rateCallback(rating, done) {

                done();
            },
            function(error) {
                done();
            }
        });


        raterComponent.setRating(parseFloat(rateElements[index].dataset.rate));
        raterComponent.disable();


    }
}
