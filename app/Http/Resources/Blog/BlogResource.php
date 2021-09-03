<?php

namespace App\Http\Resources\Blog;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
                'type'       => 'blogs',
                'blog_id'    => $this->id,
                'attributes' => [
                    'author'          => $this->author,
                    'title'           => $this->title,
                    'extract'         => $this->extract,
                    'content'         => $this->content,
                    'detail_image'    => asset('storage/' . $this->detail_image),
                    'date_to_publish' => $this->date_to_publish,
                    'time_to_publish' => $this->time_to_publish,
                    'status'          => $this->status
                ]
            ],
            'links' => [
                'self' => url('blogs/' . $this->id)
            ],
            'meta'  => [
                'message' => 'Blog registrado correctamente'
            ]

        ];
    }
}
