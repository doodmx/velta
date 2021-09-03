<?php

namespace App\Http\Requests\Course;

use App\Models\Course\CourseType;
use Illuminate\Foundation\Http\FormRequest;

class CreateCourseTypeRequest extends FormRequest
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
        return CourseType::rules();
    }

    public function messages()
    {
        return CourseType::messages();
    }
}
