require('jsviews');
require('jsrender');

import subscribeToQuestionOrderChange from "./quiz.sortable";
import {addQuestion, computeOptionsCredits, saveQuiz, fillWithFetchedQuiz} from "./app.actions";
import * as templates from './app.templates';


const currentUrl = window.location.href.split('/');
export const isEditMode = currentUrl[9] === undefined;


$(document).ready(function () {

    templates.renderizeQuizGeneral();
    templates.renderizeQuestionList();
    templates.renderizeQuestionOrderMenu();

    subscribeToQuestionOrderChange();

    if (isEditMode) {
        fillWithFetchedQuiz()
    }


    $('select').on('change', function () {
        $(this).parsley().validate();
    });


    $('#addQuestionForm')
        .parsley()
        .on('form:submit', function () {

            addQuestion();
            return false;
        });


    $('#btnSaveQuiz').on('click', async function () {

        const quizForm = $('#frmSaveQuiz');

        if (quizForm.parsley().validate()) {

            computeOptionsCredits();
            const quiz = await saveQuiz();

            window.location.href = '/admin/courses?quizSaved';

        }
    });

});

