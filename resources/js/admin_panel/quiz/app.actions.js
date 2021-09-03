import quiz from "./instance";
import * as http from "./http";
import {isEditMode} from "./app";
import {Question} from "../../models/question";
import * as alerts from "../../helpers/alerts";
import {serializeArrayToJson} from "../../helpers/json";
import QuestionOption from "../../models/question_option";
import {QuizException} from "../../exceptions/QuizException";
import {QuizQuestionException} from "../../exceptions/QuizQuestionException";
import {QuestionOptionException} from "../../exceptions/QuestionOptionException";


export function computeOptionsCredits() {

    quiz.questions.forEach((question) => {

        const questionType = question.type;
        const rightOptions = question.options.filter(option => option.is_right_one).length;


        let optionCredits = question.credits;
        if (questionType === 'checkbox') {
            optionCredits = (question.credits / rightOptions).toFixed(2);
        }


        question.options.forEach((option, optionIndex) => {

            if (option.is_right_one === 'true') {
                option.setIsRightOne(true);
            }

            if (option.is_right_one) {
                option.setCredits(optionCredits);
            }

        });


    });

}

export async function fillWithFetchedQuiz() {


    try {

        const data = await http.fetchQuiz();

        const quizData = data.data.attributes;

        // SETTING QUIZ GENERAL INFORMATION
        quiz.setId(quizData.chapter_id);
        quiz.setName(quizData.name);
        quiz.setBriefing(quizData.briefing);
        quiz.setCredits(quizData.total_credits);
        quiz.setCreditsToApprove(quizData.credits_to_approve);


        //SETTING QUIZ QUESTIONS
        const quizQuestionsData = quizData.questions.data
        let quizQuestions = [];

        quizQuestionsData.forEach(question => {

            const questionData = question.data.attributes;
            const newQuestion = new Question(
                question.data.quiz_question_id,
                questionData.name,
                questionData.credits,
                questionData.type,
                []
            );


            //SETTING QUESTION'S OPTIONS
            const questionsOptions = [];
            questionData.options.data.forEach(option => {

                const optionData = option.data.attributes;
                const newOption = new QuestionOption(
                    option.data.question_option_id,
                    optionData.option,
                    optionData.credits,
                    optionData.is_right_one
                );
                questionsOptions.push(newOption);

            });
            newQuestion.setOptions(questionsOptions);

            quizQuestions.push(newQuestion);

        });

        quiz.setQuestions(quizQuestions);
        console.log(quiz);

    } catch (e) {

        if (e instanceof QuizException) {
            alerts.errorAlert(e.name, e.message);
        }
    }


    // There's a bug with dynamic radio button checked property, it fixes it
    $('input[type=radio]').each(function (i) {
        if ($(this).attr('checked')) {
            $(this).next().trigger('click');
        }
    });


};

export function addQuestion() {

    const questionForm = $('#addQuestionForm');
    const {question, question_credits, question_type} = serializeArrayToJson(questionForm.serializeArray());

    const newQuestion = new Question(
        null, //id
        question, //name
        question_credits, //credits
        question_type, //type
        [] // answers
    );
    quiz.addQuestion(newQuestion);
    quiz.setCredits(parseInt(quiz.total_credits) + parseInt(newQuestion.credits));


    questionForm.trigger('reset');
    questionForm.parsley().reset();

    $('#addQuestionModal').modal('hide');

};

export async function deleteQuestion(index, id) {

    const willDeleteQuestion = await alerts.confirmAlert('Preguntas', '¿Estás seguro(a) de eliminar esta pregunta?');
    if (willDeleteQuestion.value) {

        try {

            if (isEditMode && id !== null) {

                await http.deleteQuestion(id);
                alerts.successAlert('Preguntas', 'Pregunta eliminada correctamente');

            }

            quiz.setCredits(parseInt(quiz.total_credits) - parseInt(quiz.questions[index].credits));
            quiz.removeQuestion(index);

        } catch (e) {

            if (e instanceof QuizQuestionException) {
                alerts.errorAlert(e.name, e.message);
            }
        }

    }

};

export function addOption(questionIndex) {

    const newOption = new QuestionOption(
        null, //id
        '',  //name
        0,  // credits
        false // is_right_one
    );

    quiz.questions[questionIndex].addOption(newOption);
};

export function onClickRadioOption(question) {

    if (question.type === 'radio') {

        question.options.forEach((option, key) => {
            option.setIsRightOne(key === option.index);
        })
    }
};

export async function deleteOption(question, option) {


    const willDeleteOption = await alerts.confirmAlert('Opciones', '¿Estás seguro(a) de eliminar esta opción?');
    if (willDeleteOption.value) {

        try {

            if (isEditMode && option.id !== null) {

                await http.deleteOption(question.id, option.id);
                alerts.successAlert('Opciones', 'Opción eliminada correctamente');

            }
            quiz.questions[question.index].deleteOption(option.index);


        } catch (e) {

            if (e instanceof QuestionOptionException) {
                alerts.errorAlert(e.name, e.message);
            }
        }


    }
};

export async function saveQuiz() {

    const requestMethod = isEditMode ? 'PATCH' : 'POST';
    try {

        await http.sendQuiz(requestMethod);

    } catch (e) {

        if (e instanceof QuizException) {
            if (e.validationErrors !== '') {
                alerts.errorAlert(e.name, e.validationErrors);
            } else {
                alerts.errorAlert(e.name, e.message);

            }
        }
    }
}

