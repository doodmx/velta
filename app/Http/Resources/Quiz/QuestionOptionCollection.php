<?php

namespace App\Http\Resources\Quiz;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuestionOptionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data'  => $this->collection,
            'links' => [
                'self' => url('/courses/' . $this->collection[0]->question->quiz->chapter->parent_course_id . '/chapters/' . $this->collection[0]->question->chapter_quiz_id . '/quiz/questions/' . $this->collection[0]->question->id . '/options'),
            ]
        ];
    }
}
