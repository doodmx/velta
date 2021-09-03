<?php

namespace App\Repositories\Course;

use DB;
use App\Models\Course\CourseType;
use App\Interfaces\Course\CourseTypeWebInterface;


class CourseTypeWebRepository implements CourseTypeWebInterface
{
    protected $courseType;

    public function __construct()
    {
        $this->courseType = app(CourseType::class)->make();

    }

    public function paginateActive($rowsPerPage, $filter)
    {
        return $this->courseType
            ->paginate($rowsPerPage);
    }

    public function showByLocale()
    {
        return $this->courseType
            ->where('name->' . app()->getLocale(), '<>', '')
            ->get();
    }


    public function showPopular($limit)
    {

        return $this->courseType
            ->select('*',
                DB::raw(
                    <<<SQL
                    (
                        SELECT count(*) 
                        FROM `partner_course` 
                        INNER JOIN `course_has_types` ON `course_has_types`.`course_id` = `partner_course`.`course_id`
                        WHERE `course_type`.`id` = `course_has_types`.`course_type_id`
                    ) AS enrolls_count
SQL
                ),
                DB::raw(
                    <<<SQL
                    (
                         SELECT count(*) 
                         FROM `course_doubt` 
                         INNER JOIN `course_has_types` ON `course_has_types`.`course_id` = `course_doubt`.`course_id` 
                         WHERE `course_type`.`id` = `course_has_types`.`course_type_id`
                    ) AS doubts_count
SQL
                )
            )
            ->orderBy('enrolls_count', 'desc')
            ->orderBy('doubts_count', 'desc')
            ->limit($limit)
            ->with('seo')
            ->get();
    }


}
