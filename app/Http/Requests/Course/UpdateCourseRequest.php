<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'course.name'            => 'required|unique_translation:course,name,' . $this->id . ',id',
            'course_type.*'          => 'required|exists:course_type,id',
            'course.excerpt'         => 'required|max:150',
            'course.thumbnail'       => 'mimes:jpeg,bmp,png,gif,jpg',
            'course.currency_id'     => 'nullable|regex:/^[1-9]\d*$/|exists:currency,id',
            'course.price'           => 'nullable|numeric',
            'course_seo.separator'   => 'required',
            'course_seo.slug'        => 'required',
            'course_seo.title'       => 'required',
            'course_seo.description' => 'required',
            'course_seo.image_alt'   => 'required'
        ];
    }


}
