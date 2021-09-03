<?php

namespace App\Http\Requests\Partner;

use App\Interfaces\Quiz\QuizInterface;
use Illuminate\Foundation\Http\FormRequest;
use App\Interfaces\Partner\EnrollInterface;
use Illuminate\Auth\Access\AuthorizationException;
use App\Interfaces\Partner\PartnerQuizScoreInterface;

class ShowEnrollQuizRequest extends FormRequest
{

    private $error;
    public $quiz;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(EnrollInterface $enrollContract, QuizInterface $quizContract, PartnerQuizScoreInterface $partnerQuizScore)
    {

        $id = request()->segment(2);

        $enroll = $enrollContract->courseIsCompleted($id);


        if (!$enroll['completed']) {

            $this->error = __('courses/quiz.course_undone');
            return false;
        }


        $this->quiz = $quizContract->showCertificationQuiz($enroll['course']);
        if (empty($this->quiz)) {
            $this->error = __('courses/quiz.quiz_undone');
            return false;
        }

        $quizScore = $partnerQuizScore->showCertificationQuiz(auth()->user()->id, $this->quiz->chapter_id);
        if (!empty($quizScore)) {
            $this->error = __('courses/quiz.quiz_done');
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
            //
        ];
    }
}
