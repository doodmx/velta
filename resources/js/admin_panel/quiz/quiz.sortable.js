import quiz from "./instance";
import Sortable from "sortablejs";


export default function subscribeToQuestionOrderChange() {

    let oldQuestionIndex = -1;
    let questionsMenu = document.getElementById('questions-menu');

    Sortable.create(questionsMenu, {
        handle: '.handle',
        animation: 150,
        ghostClass: 'blue-background-class',
        onChoose: function (evt) {
            oldQuestionIndex = evt.oldDraggableIndex;

        },
        onEnd: function (evt) {

            const newQuestionIndex = evt.newDraggableIndex;
            const newQuestions = quiz.questions.slice(0);

            const oldQuestion = newQuestions[oldQuestionIndex];
            const newQuestion = newQuestions[newQuestionIndex];


            newQuestions[oldQuestionIndex] = newQuestion;
            newQuestions[newQuestionIndex] = oldQuestion;

            $.observable(quiz.questions).refresh(newQuestions);


        }
    });
}
