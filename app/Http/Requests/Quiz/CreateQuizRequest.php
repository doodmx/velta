<?php

namespace App\Http\Requests\Quiz;

use App\Interfaces\Course\ChapterInterface;
use Illuminate\Foundation\Http\FormRequest;

class CreateQuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(ChapterInterface $chapterContract)
    {
        $courseId = request()->segment(3);
        $chapterId = request()->segment(5);

        return $chapterContract->belongsToRightCourse($chapterId, $courseId);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [
            'quiz.name'                            => 'required',
            'quiz.briefing'                        => 'nullable',
            'quiz.total_credits'                   => 'required|regex:/^[1-9]\d*$/',
            'quiz.credits_to_approve'              => 'required|regex:/^[1-9]\d*$/',
            'questions.*.name'                     => 'required',
            'questions.*.type'                     => 'required|in:radio,checkbox',
            'questions.*.credits'                  => 'required|regex:/^[1-9]\d*$/',
            'questions.*.options.*.option.*'       => 'required',
            'questions.*.options.*.is_right_one.*' => 'required|boolean',
            'questions.*.options.*.credits.*'      => 'required|boolean',
        ];
    }
}
