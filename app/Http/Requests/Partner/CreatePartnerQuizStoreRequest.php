<?php

namespace App\Http\Requests;

use App\Interfaces\Quiz\QuizInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Interfaces\Partner\PartnerQuizScoreInterface;

class CreatePartnerQuizStoreRequest extends FormRequest
{

    private $error;
    public $quiz;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(PartnerQuizScoreInterface $quizScoreContract, QuizInterface $quizContract)
    {

        $certificationDone = $quizScoreContract->showCertificationQuiz(auth()->user()->id, request()->get('quiz_score')['chapter_quiz_id']);
        $this->quiz = $quizContract->show(request()->get('quiz_score')['chapter_quiz_id']);


        if (!empty($certificationDone)) {

            $this->error =__('courses/quiz.quiz_done');
            return false;

        }

        if ($this->quiz->credits_to_approve > request()->get('quiz_score')['score']) {
            $this->error = __('courses/quiz.minimum_score');
            return false;
        }


        return true;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException($this->error);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quiz_score.chapter_quiz_id'   => 'required|regex:/^[1-9]\d*$/|exists:chapter_quiz,chapter_id',
            'quiz_score.score'             => 'required|numeric',
            'answers.*.question_option_id' => 'required|regex:/^[1-9]\d*$/|exists:question_option,id'
        ];
    }
}
