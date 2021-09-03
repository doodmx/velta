<?php

namespace App\Http\Requests\Blog;

use App\Models\Blog\Blog;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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


    protected function prepareForValidation()
    {

        $this->merge([
            'blog' => Blog::transformBlogRequest($this->request)
        ]);

    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'blog.author'          => 'required',
            'blog.title'           => 'required|unique:blog,title,' . $this->id . ',id',
            'blog.extract'         => 'required|max:150',
            'blog.content'         => 'required',
            'blog.detail_image'    => 'nullable|mimes:jpeg,bmp,png,gif,jpg',
            'blog.date_to_publish' => 'required|date_format:Y-m-d',
            'blog.time_to_publish' => 'required|date_format:H:i:s',
            'blog.category_id'     => 'required|integer',
            'blog_tag'             => 'required',
            'blog_tag.*'           => 'integer',
            'blog_seo.separator'   => 'required',
            'blog_seo.slug'        => 'required',
            'blog_seo.title'       => 'required',
            'blog_seo.description' => 'required',
            'blog_seo.image_alt'   => 'required'
        ];
    }
}
