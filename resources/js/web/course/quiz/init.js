import quiz from './instance';
import {Question} from "../../../models/question";
import QuestionOption from '../../../models/question_option';


export function fillQuiz() {

    const loadedQuiz = $('#localData').data('quiz');


    quiz.setId(loadedQuiz.chapter_id);
    quiz.setName(loadedQuiz.name);
    quiz.setBriefing(loadedQuiz.briefing);
    quiz.setCredits(loadedQuiz.total_credits);
    quiz.setCreditsToApprove(loadedQuiz.credits_to_approve);


    let quizQuestions = [];
    loadedQuiz.questions.forEach(question => {

        const newQuestion = new Question(
            question.id,
            question.name,
            question.credits,
            question.type,
            []
        );


        //SETTING QUESTION'S OPTIONS
        const questionsOptions = [];
        question.options.forEach(option => {
            const newOption = new QuestionOption(
                option.id,
                option.option,
                option.credits,
                option.is_right_one
            );
            questionsOptions.push(newOption);

        });
        newQuestion.setOptions(questionsOptions);

        quizQuestions.push(newQuestion);


    });
    quiz.setQuestions(quizQuestions);

}
