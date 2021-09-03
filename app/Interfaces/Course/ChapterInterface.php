<?php

namespace App\Interfaces\Course;

interface ChapterInterface
{
    public function paginate($filter);

    public function addRoot($courseId);

    public function add($chapterData);

    public function belongsToRightCourse($chapterId, $courseId);

    public function show($id);

    public function showRoot($courseId);

    public function update($chapterId, $chapterData);

    public function delete($chapterId);

    public function showChapters($courseId, $chapterId, $depth = 1);

    public function showChildren($courseId, $chapterId);
}

