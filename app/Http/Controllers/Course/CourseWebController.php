<?php

namespace App\Http\Controllers\Course;

use App\Traits\SEOPageMeta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Course\CourseWebInterface;
use App\Interfaces\Course\CourseTypeInterface;
use App\Interfaces\Course\CourseTypeWebInterface;

class CourseWebController extends Controller
{
    private $courseTypes, $courseTypesWeb, $courses;

    use SEOPageMeta;

    public function __construct(CourseTypeInterface $courseTypeContract,
                                CourseWebInterface $courseWebContract,
                                CourseTypeWebInterface $courseTypeWebContract)
    {

        $this->courses = $courseWebContract;
        $this->courseTypes = $courseTypeContract;
        $this->courseTypesWeb = $courseTypeWebContract;

    }


    public function all(Request $request)
    {
        $courses = $this->courses->paginateActive(9, $request->all());
        $categories = $this->courseTypesWeb->showByLocale();

        $courses->appends($request->except('page'))->links();
        return view('web.courses.all')
            ->with([
                'categories' => $categories,
                'courses'    => $courses
            ]);;

    }

    public function show($slug, Request $request)
    {


        $course = $this->courses->showBySlug($slug);


        $authenticatedUser = auth()->user();
        $enroll = null;
        if ($authenticatedUser) {
            $enroll = $course->enrolls->where('partner_id', '=', $authenticatedUser->id)->first();


        }


        $this->setPageTags([
            'title'       => $course->seo->title,
            'description' => $course->seo->description,
            'keywords'    => [],
            'separator'   => $course->seo->separator,
            'url'         => url($request->path()),
            'image'       => asset('courses/' . $course->thumbnail)
        ]);


        return view('web.courses.detail')
            ->with([
                'course'  => $course,
                'preview' => $course->chapters_tree->whereNotNull('video_link')->first(),
                'enroll'  => $enroll
            ]);


    }


}
