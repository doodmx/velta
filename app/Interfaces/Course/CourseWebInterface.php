<?php

namespace App\Interfaces\Course;

interface CourseWebInterface
{


    public function paginateActive($rowsPerPage, $filter);

    public function showBySlug($slug);

    public function showRecents($limit);


}

