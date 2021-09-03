<?php

namespace App\Http\Requests\Course;

use App\Models\Course\Course;
use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
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
            'course.name'            => 'required|unique_translation:course,name',
            'course_type.*'          => 'required|exists:course_type,id',
            'course.excerpt'         => 'required|max:150',
            'course.currency_id'     => 'nullable|exists:currency,id',
            'course.price'           => 'nullable|numeric',
            'course.thumbnail'       => 'required |mimes:jpeg,bmp,png,gif,jpg',
            'course_seo.separator'   => 'required',
            'course_seo.slug'        => 'required',
            'course_seo.title'       => 'required',
            'course_seo.description' => 'required',
            'course_seo.image_alt'   => 'required'
        ];
    }

}
