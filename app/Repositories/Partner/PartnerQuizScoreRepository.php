<?php

namespace App\Repositorie\Partner;

use DB;
use Illuminate\Database\QueryException;
use App\Models\Partner\PartnerQuizScore;
use App\Exceptions\Helpers\DatabaseException;
use App\Interfaces\Partner\PartnerQuizScoreInterface;


class PartnerQuizScoreRepository implements PartnerQuizScoreInterface
{
    protected $quizScore;

    public function __construct()
    {
        $this->quizScore = app(PartnerQuizScore::class)->make();


    }

    public function showCertificationQuiz($partnerId, $chapterQuizId)
    {

        return $this->quizScore->where('partner_id', $partnerId)
            ->where('chapter_quiz_id', $chapterQuizId)
            ->first();
    }

    public function store($data)
    {

        try {

            DB::beginTransaction();


            $quizScore = $this->quizScore->create($data['quiz_score']);

            foreach ($data['answers'] as $answer) {

                $quizScore->answers()->create($answer);
            }


            DB::commit();

            return $quizScore;


        } catch (QueryException $e) {

            DB::rollBack();
            throw new DatabaseException();
        }
    }
}
