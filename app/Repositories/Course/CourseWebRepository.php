<?php

namespace App\Repositories\Course;

use DB;
use App\Models\Course\Course;
use App\Interfaces\Course\ChapterInterface;
use App\Interfaces\Course\CourseWebInterface;
use App\Exceptions\Course\CourseNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CourseWebRepository implements CourseWebInterface
{

    protected $course, $chapters;

    public function __construct(ChapterInterface $chaptersContract)
    {
        $this->course = app(Course::class);
        $this->chapters = $chaptersContract;
    }


    public function paginateActive($rowsPerPage, $filter)
    {

        return $this->course
            ->join('course_has_types', 'course_has_types.course_id', '=', 'course.id')
            ->join('course_type_seo', 'course_has_types.course_type_id', '=', 'course_type_seo.course_type_id')
            ->when(!empty($filter), function ($query) use ($filter) {

                if (isset($filter['category'])) {
                    return $query->where('course_type_seo.slug->' . app()->getLocale(), '=', $filter['category']);
                }

                if (isset($filter['best-rate'])) {
                    return $query->orderBy('average_rate', 'desc');
                }
                if (isset($filter['free'])) {
                    return $query->free();
                }
                if (isset($filter['lower_price'])) {
                    return $query->orderBy('price', 'asc');
                }
                if (isset($filter['higher_price'])) {
                    return $query->orderBy('price', 'desc');
                }
            })
            ->recents()
            ->where('course.name->' . app()->getLocale(), '<>', '')
            ->with(['currency', 'seo'])
            ->groupBy('course.id')
            ->paginate($rowsPerPage);

        return $courses;
    }

    public function showRecents($limit)
    {

        return $this->course
            ->recents()
            ->limit($limit)
            ->with(['currency', 'seo'])
            ->get();
    }

    public function showBySlug($slug)
    {
        try {

            $course = $this->course
                ->whereHas('seo', function ($query) use ($slug) {
                    $query->where('slug->' . app()->getLocale(), $slug);
                })
                ->with([
                    'seo',
                    'instructor.profile',
                    'chapters'                => function ($query) {
                        return $query->select('id', 'parent_course_id', 'title', 'video_link')
                            ->where('title', 'Root')
                            ->orWhere(function ($query) {

                                return $query->whereNotNull('video_link')->first();
                            })
                            ->get();
                    },
                    'currency',
                    'enrolls'                 => function ($query) {

                        return $query->select('partner_course.id', 'course_id', 'partner_id', 'rate', 'comment', 'partner_course.updated_at')
                            ->whereHas('partner', function ($query) {
                                return $query->where('user.locale', app()->getLocale());
                            });

                    },
                    'enrolls.partner'         => function ($query) {
                        return $query->select('id', 'email');
                    },
                    'enrolls.partner.profile' => function ($query) {
                        return $query->select('user_id', 'name', 'lastname');
                    }
                ])
                ->firstOrFail();

            $course->preview = $course->chapters->whereNotNull('video_link')->first();
            $course->chapters_tree = $this->chapters->showChapters($course->id, $course->chapters->where('title', 'Root')->first()->id, 1);


            return $course;

        } catch (ModelNotFoundException $e) {

            throw new CourseNotFoundException();
        }
    }

}
