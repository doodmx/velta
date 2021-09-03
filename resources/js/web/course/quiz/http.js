import '../../../helpers/axios'
import {QuizException} from "../../../exceptions/QuizException";
import messages from '../../../lang/quiz';

const enroll = $('#localData').data('enroll');


export async function postQuiz(quizResult) {


    try {

        return await axios.post(`/enrolls/${enroll}/quiz`, quizResult);

    } catch (e) {

        let message = messages.error[appLocale];
        if (e.response.data.errors) {
            message = e.response.data.errors.title;
        }

        const quizException = new QuizException(message);
        quizException.setName(messages.module[appLocale]);

        throw quizException;
    }
}
