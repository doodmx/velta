<?php

namespace App\Interfaces\Quiz;

interface QuizInterface
{


    public function canCreateQuiz($courseId, $chapterId);

    public function store($chapterId, array $data);

    public function checkIfExists($chapterId);

    public function show($chapterId);

    public function update($chapterId, array $data);

    public function showCertificationQuiz($courseId);

}
