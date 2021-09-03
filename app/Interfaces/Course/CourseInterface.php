<?php

namespace App\Interfaces\Course;

interface CourseInterface
{


    public function showAll();

    public function paginate($filter);

    public function create($courseData);

    public function update($id, $courseData);

    public function show($id);

    public function restore($id);

    public function delete($id);


}

