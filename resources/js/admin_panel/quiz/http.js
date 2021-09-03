import quiz from "./instance";
import '../../helpers/axios';
import {QuizException} from "../../exceptions/QuizException";
import {QuizQuestionException} from "../../exceptions/QuizQuestionException";
import {QuestionOptionException} from "../../exceptions/QuestionOptionException";


const currentUrl = window.location.href.split('/');
const courseId = currentUrl[5];
const chapterId = currentUrl[7];

export async function fetchQuiz() {

    try {

        const {data} = await axios.get(`/admin/courses/${courseId}/chapters/${chapterId}/quiz`, {data: {}});
        return data;

    } catch (e) {
        throw new QuizException('No se pudo encontrar el cuestionario solicitado con identificador: ' + chapterId);
    }

};

export async function sendQuiz(method) {

    let api = `/admin/courses/${courseId}/chapters/${chapterId}/quiz`

    try {
        const {data} =await axios.request({
            method: method,
            url: api,
            data: {
                quiz: {
                    name: quiz.name,
                    briefing: quiz.briefing,
                    total_credits: quiz.total_credits,
                    credits_to_approve: quiz.credits_to_approve,
                },
                questions: {...quiz.questions}
            }
        });

        return data;

    } catch (e) {

        const codeStatus = e.response.status;
        const quizException = new QuizException('Hubo un error al guardar el cuestionario.');

        if (codeStatus === 422) {
            quizException.setValidationErrors(e.response.data.errors.meta);
        }

        throw quizException;
    }

};

export async function deleteQuestion(id) {
    let api = `/admin/courses/${courseId}/chapters/${chapterId}/quiz/questions/${id}`;
    try {

        await axios.delete(api);

    } catch (e) {
        throw new QuizQuestionException('Hubo un error al eliminar la pregunta con identificador: ' + id);
    }
};


export async function deleteOption(questionId, optionId) {

    let api = `/admin/courses/${courseId}/chapters/${chapterId}/quiz/questions/${questionId}/options/${optionId}`;
    try {

        await axios.delete(api);

    } catch (e) {
        throw new QuestionOptionException('Hubo un error al eliminar la opción con identificador: ' + optionId);
    }

};



