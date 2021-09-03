<?php

namespace App\Interfaces\Partner;

interface PartnerQuizScoreInterface
{


    public function showCertificationQuiz($partnerId,$chapterId);

    public function store($data);


}
