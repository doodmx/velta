import quiz from "./instance";
import * as actions from "./app.actions";
import getQuizHtml from "./templates/general";
import {questionTypes} from "../../models/question";
import getQuestionsHtml from "./templates/questions";
import getQuestionsMenuHtml from "./templates/questions.list_menu";


export function renderizeQuizGeneral() {

    const quizTemplate = $.templates(getQuizHtml());
    quizTemplate.link('#quiz-general', quiz);

}

export function renderizeQuestionList() {

    const questionsTemplate = $.templates(getQuestionsHtml());
    questionsTemplate.link('#questions', quiz.questions, {

        //Helper to get a human description of the question type
        getType: (type) => {
            const typeDescription = questionTypes.find(questionType => questionType.name === type)
            if (typeDescription === undefined)
                return ''

            return typeDescription.description;
        },
        getLocale: () => {
            return appLocale;
        }
    })
        .on('click', '.delete-question', async function () {

            const question = $.view(this)
            actions.deleteQuestion(question.index, question.data.id);

        })
        .on('click', '.add-option', function () {


            const questionIndex = $.view(this).getIndex();
            actions.addOption(questionIndex);

        })
        .on('click', '.delete-option', async function () {

            const option = $.view(this);
            const question = $.view(this).parent.ctx.question[0];

            actions.deleteOption(
                {index: question.index, id: question.data.id},
                {index: option.index, id: option.data.id}
            );


        })
        .on('click', '.question-option', function () {

            const questionIndex = $.view(this).parent.ctx.question[0].index;
            const question = quiz.questions[questionIndex];

            actions.onClickRadioOption(question.type, question);

        });

};

export function renderizeQuestionOrderMenu() {

    const questionsSidebarTemplate = $.templates(getQuestionsMenuHtml());
    questionsSidebarTemplate.link('#questions-menu', quiz.questions);

}
