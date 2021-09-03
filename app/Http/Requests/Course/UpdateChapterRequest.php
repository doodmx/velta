<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChapterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function attributes()
    {
        return [
            'parent_node_id'   => 'capítulo padre',
            'parent_course_id' => 'curso',
            'title'            => 'nombre',
            'video_link'       => 'video',
            'description'      => 'descripción',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_node_id'   => 'required|regex:/^[1-9]\d*$/|exists:course_chapter,id',
            'parent_course_id' => 'required|regex:/^[1-9]\d*$/|exists:course_chapter,parent_course_id',
            'title'            => 'required|unique:course_chapter,title,' . $this->id . ',id,parent_course_id,' . $this->course_id,
            'video_link'       => 'nullable|url',
            'description'      => 'nullable|max:150',
            'icon'             => 'nullable|mimes:jpeg,bmp,png,gif,jpg'
        ];
    }
}
