<?php

namespace App\Repositories\Course;

use DB;
use App\Models\Course\Course;
use App\Interfaces\Course\CourseInterface;
use App\Interfaces\Course\ChapterInterface;
use App\Exceptions\Helpers\DatabaseException;
use App\Exceptions\Course\CourseNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CourseRepository implements CourseInterface
{
    protected $course, $chapters;

    public function __construct(ChapterInterface $chapterContract)
    {
        $this->course = app(Course::class);
        $this->chapters = $chapterContract;
    }


    public function showAll()
    {
        return $this->course->with('seo')->get();
    }

    public function paginate($filter)
    {

        $courses = $this->course->newQuery()
            ->select('course.id', 'course.name', 'course.thumbnail', 'course.total_chapters', 'course.deleted_at');

        if (isset($filter['course_type'])) {
            $courses->whereHas('categories', function ($query) use ($filter) {
                return $query->whereIn('course_type.id', $filter['course_type']);
            });
        }

        if (isset($filter['course_status'])) {

            if ($filter['course_status'] == 'deleted')
                $courses->deleted();

            if ($filter['course_status'] == 'all')
                $courses->all();
        }

        $courses
            ->with(['chapters' => function ($query) {
                $query->where('course_chapter.title', 'Root');
            }])
            ->groupBy('course.id');


        return $courses;
    }

    public function create($data)
    {
        try {

            DB::beginTransaction();

            $course = $this->course->create(
                array_merge(
                    ["instructor_id" => Course::DEFAULT_INSTRUCTOR],
                    $data['course']
                )
            );
            $this->chapters->addRoot($course->id);


            $course->seo()->create($data['course_seo']);
            $course->categories()->attach($data['course_type']);


            DB::commit();

            return $course;

        } catch (\Exception $e) {
            DB::rollBack();

            throw new DatabaseException();
        }
    }

    public function update($id, $data)
    {

        $locale = app()->getLocale();
        $course = $this->show($id);
        $data['course']['thumbnail'] = value_instead($data['course'], 'thumbnail', $course->thumbnail);


        try {

            DB::beginTransaction();


            $course->update(array_merge(
                ["instructor_id" => Course::DEFAULT_INSTRUCTOR],
                $data['course']
            ));

            $course->categories()->sync($data['course_type']);


            $seo = $course->seo;

            $seo->setTranslation('slug', $locale, $data['course_seo']['slug']);
            $seo->setTranslation('title', $locale, $data['course_seo']['title']);
            $seo->setTranslation('image_alt', $locale, $data['course_seo']['image_alt']);
            $seo->setTranslation('separator', $locale, $data['course_seo']['separator']);
            $seo->setTranslation('description', $locale, $data['course_seo']['description']);

            $seo->save();




            DB::commit();


            return $course;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new DatabaseException();
        }
    }


    public function show($id)
    {

        try {

            $course = $this->course->with(['seo', 'categories'])->findOrFail($id);

            return $course;

        } catch (ModelNotFoundException $e) {

            throw new CourseNotFoundException();
        }

    }

    public function restore($id)
    {
        try {

            $course = $this->course->onlyTrashed()->findOrFail($id);
            $course->restore();

        } catch (ModelNotFoundException $e) {

            throw new CourseNotFoundException();
        }


    }

    public function delete($id)
    {

        $course = $this->show($id);


        $course->delete();

    }


}
