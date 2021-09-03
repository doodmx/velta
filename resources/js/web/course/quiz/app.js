import {fillQuiz} from "./init";
import {computeScore} from "./actions";
import {QuizException} from "../../../exceptions/QuizException";
import {errorAlert, successAlert} from "../../../helpers/alerts";
import {postQuiz} from "./http";
import messages from '../../../lang/quiz';

$(function () {

    window.Parsley.setLocale(appLocale);
    fillQuiz();

    $('#saveQuiz')
        .on('click', async function () {

            const quizForm = $('#frmQuiz');
            const quizFormIsValid = quizForm.parsley().validate();


            if (quizFormIsValid) {


                try {

                    const quizResult = computeScore();
                    quizForm.trigger('reset');
                    const response = await postQuiz(quizResult);

                    successAlert(messages.module[appLocale], messages.success[appLocale]);

                } catch (e) {

                    if (e instanceof QuizException) {
                        errorAlert(e.name, e.message);
                    }
                }


            }

        });

});
