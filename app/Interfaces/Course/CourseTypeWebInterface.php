<?php

namespace App\Interfaces\Course;

interface CourseTypeWebInterface
{


    public function paginateActive(int $rowsPerPage, $filter);

    public function showByLocale();

    public function showPopular($limit);

}
