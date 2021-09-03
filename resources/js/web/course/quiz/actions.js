import quiz from './instance';

export function computeScore() {


    let quizResult = {
        quiz_score: {
            chapter_quiz_id: quiz.id,
            score: 0
        },
        answers: []

    }

    const allAnswers = $('input:checked');


    quiz.questions.forEach(question => {


        const answersPerQuestion = allAnswers
            .filter(function () {
                return $(this).data('question') === question.id;
            })
            .map(function (index, element) {
                return question.options.find(option => option.id === $(this).data('answer'));
            })
            .get();


        if (question.type === 'radio') {
            quizResult.quiz_score.score += parseFloat(answersPerQuestion[0].credits);
            return false;
        }


        const baseRightCredits = question.options.find(option => option.is_right_one).credits;

        const rightChecks =
            answersPerQuestion
                .filter(answer => answer.is_right_one)
                .map(answer => answer.credits);


        if (rightChecks.length > 0) {

            const rightScore = rightChecks.reduce((total, currentValue) => parseFloat(total) + parseFloat(currentValue));
            const wrongChecks = answersPerQuestion
                .filter(answer => !answer.is_right_one)
                .length;

            const badScore = (parseInt(wrongChecks) * parseFloat(baseRightCredits)).toFixed(2);

            if (rightScore > 0 && badScore <= question.credits) {
                quizResult.quiz_score.score += parseFloat(rightScore) - parseFloat(badScore);
            }
        }


    });


    allAnswers.each(function (index, element) {
        quizResult.answers.push({
            question_option_id: $(this).data('answer')
        })
    });

    return quizResult;

}
