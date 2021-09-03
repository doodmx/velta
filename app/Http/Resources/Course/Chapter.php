<?php

namespace App\Http\Resources\Course;

use Illuminate\Http\Resources\Json\JsonResource;

class Chapter extends JsonResource
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
                'type'       => 'chapters',
                'chapter_id' => $this->id,
                'attributes' => [
                    'id'               => $this->id,
                    'parent_course_id' => $this->parent_course_id,
                    'title'            => $this->translated_title,
                    'description'      => $this->description,
                    'icon'             => !empty($this->icon) ? asset('storage/' . $this->icon) :'https://cdn.veltacorp.com/img/placeholder.svg',
                    'video_link'       => $this->video_link
                ]
            ],
            'links' => [
                'self' => url('courses/' . $this->parent_course_id . '/chapters/' . $this->id)
            ],
            'meta'  => [
                'message' => 'Capítulo guardado correctamente'
            ]

        ];
    }
}
