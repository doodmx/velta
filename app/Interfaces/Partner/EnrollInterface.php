<?php

namespace App\Interfaces\Partner;

interface EnrollInterface
{


    public function addPartner($courseId, $partnerId);

    public function courseIsCompleted($enrollId);

    public function showLearningCourses($partnerId);

    public function showLearningCourse($enrollId);

    public function updateCourseProgress($enrollId);

    public function chapterIsDone($enrollId, $chapterId);

    public function chapterIsPendant($enrollId, $chapterId);

    public function setCourseCertificate($enrollId, $certificate);

    public function addReview($enrollId, $data);


}
