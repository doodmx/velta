<?php

namespace App\Http\Resources\Quiz;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionOption extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data'  => [
                'type'               => 'question_options',
                'question_option_id' => $this->id,
                'attributes'         => [
                    'option'       => $this->option,
                    'credits'      => $this->credits,
                    'is_right_one' => $this->is_right_one
                ]
            ],
            'links' => [
                'self' => url('/courses/' . $this->question->quiz->chapter->parent_course_id . '/chapters/' . $this->question->chapter_quiz_id . '/quiz/questions/' . $this->question->id . '/options/' . $this->id),
            ]
        ];
    }
}
