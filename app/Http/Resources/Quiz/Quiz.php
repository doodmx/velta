<?php

namespace App\Http\Resources\Quiz;

use Illuminate\Http\Resources\Json\JsonResource;

class Quiz extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $questions = $this->questions()->orderBy('order', 'asc')->get();

        if ($questions->isEmpty()) {
            $questions = null;
        } else {
            $questions = new QuizQuestionCollection($questions);
        }
        return [
            'data'  => [
                'type'       => 'quizzes',
                'quiz_id'    => $this->chapter_id,
                'attributes' => [
                    'name'               => $this->name,
                    'briefing'           => $this->briefing,
                    'total_credits'      => $this->total_credits,
                    'credits_to_approve' => $this->credits_to_approve,
                    'questions'          => $questions
                ]
            ],
            'links' => [
                'self' => url('courses/' . $this->chapter->parent_course_id . '/chapters/' . $this->chapter_id . '/quiz')
            ]
        ];
    }
}
