<?php

namespace App\Http\Resources\Quiz;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizQuestion extends JsonResource
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
                'type'             => 'quiz_questions',
                'quiz_question_id' => $this->id,
                'attributes'       => [
                    'name'    => $this->name,
                    'type'    => $this->type,
                    'order'   => $this->order,
                    'credits' => $this->credits,
                    'options' => new QuestionOptionCollection($this->options)
                ]
            ],
            'links' => [
                'self' => url('courses/' . $this->quiz->chapter->parent_course_id . '/chapters/' . $this->quiz->chapter_id . '/quiz/questions/' . $this->id)
            ]
        ];
    }
}
