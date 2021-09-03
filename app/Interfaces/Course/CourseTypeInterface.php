<?php

namespace App\Interfaces\Course;

interface CourseTypeInterface
{


    public function all();

    public function allActive();

    public function allDeleted();

    public function paginate($filter);

    public function create($dat);

    public function update($id, $data);

    public function show($id);

    public function restore($id );

    public function delete($id);


}

