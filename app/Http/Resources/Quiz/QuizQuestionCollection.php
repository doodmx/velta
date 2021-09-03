<?php

namespace App\Http\Resources\Quiz;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuizQuestionCollection extends ResourceCollection
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
                'self' => url('/courses/' . $this->collection[0]->quiz->chapter->parent_course_id . '/chapters/' .  $this->collection[0]->quiz->chapter_id . '/quiz/questions'),
            ]
        ];
    }
}
