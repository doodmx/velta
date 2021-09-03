<?php

namespace App\Repositories;

use DB;
use App\Models\Quiz\Quiz;
use App\Interfaces\Quiz\QuizInterface;
use Illuminate\Database\QueryException;
use App\Exceptions\Helpers\DatabaseException;
use App\Exceptions\Quiz\QuizNotFoundException;
use App\Interfaces\Quiz\QuizQuestionInterface;
use App\Interfaces\Quiz\QuestionOptionInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class QuizRepository implements QuizInterface
{
    protected $quiz, $questions, $options;

    public function __construct(QuizQuestionInterface $quizQuestionContract, QuestionOptionInterface $questionOptionContract)
    {
        $this->quiz = app(Quiz::class)->make();

        $this->questions = $quizQuestionContract;
        $this->options = $questionOptionContract;

    }


    public function canCreateQuiz($courseId, $chapterId)
    {

        $quizzesCreated = $this->quiz->select(DB::raw('count(chapter_id) as total'))
            ->whereIn('chapter_id', function ($query) use ($courseId, $chapterId) {
                return $query->select('id')
                    ->from('course_chapter')
                    ->where('parent_course_id', $courseId)
                    ->where('id', '<>', $chapterId);
            })
            ->get();


        return $quizzesCreated[0]->total === 0;
    }

    public function store($chapterId, array $data)
    {


        try {

            DB::beginTransaction();

            $quiz = $this->quiz->create(array_merge(
                ['chapter_id' => $chapterId],
                $data['quiz']
            ));

            foreach ($data['questions'] as $key => $question) {

                $savedQuestion = $this->questions->create(array_merge(
                    ['chapter_quiz_id' => $chapterId, 'order' => $key],
                    $question
                ));


                foreach ($question['options'] as $option) {

                    $this->options->create(array_merge(
                        ['quiz_question_id' => $savedQuestion->id],
                        $option
                    ));

                }
            }

            DB::commit();

            return $quiz;

        } catch (QueryException $e) {

            DB::rollBack();

            throw new DatabaseException();


        }


    }

    public function checkIfExists($chapterId)
    {
        $quiz = $this->quiz->find($chapterId);

        return $quiz !== null;

    }

    public function show($chapterId)
    {

        try {

            $quiz = $this->quiz->findOrFail($chapterId);

            return $quiz;

        } catch (ModelNotFoundException $e) {
            throw new QuizNotFoundException();
        }
    }

    public function update($chapterId, array $data)
    {

        $quiz = $this->show($chapterId);


        try {

            DB::beginTransaction();

            $quiz->name = $data['quiz']['name'];
            $quiz->briefing = $data['quiz']['briefing'];
            $quiz->total_credits = $data['quiz']['total_credits'];
            $quiz->credits_to_approve = $data['quiz']['credits_to_approve'];

            $quiz->save();

            foreach ($data['questions'] as $key => $question) {

                if (empty($question['id'])) {

                    $savedQuestion = $this->questions->create(array_merge(
                        ['chapter_quiz_id' => $chapterId, 'order' => $key],
                        $question
                    ));
                } else {

                    $savedQuestion = $this->questions->update($question['id'], array_merge($question, ['order' => $key]));
                }

                foreach ($question['options'] as $option) {

                    if (empty($option['id'])) {

                        $this->options->create(array_merge(
                            ['quiz_question_id' => $savedQuestion->id],
                            $option
                        ));

                    } else {

                        $this->options->update($option['id'], $option);

                    }
                }

            }


            DB::commit();

            return $quiz;


        } catch (QueryException $e) {

            DB::rollBack();

            throw new DatabaseException();

        }
    }

    public function showCertificationQuiz($courseId)
    {

        try {

            $quiz = $this->quiz->select('chapter_id', 'name', 'briefing', 'total_credits', 'credits_to_approve')
                ->whereIn('chapter_id', function ($query) use ($courseId) {
                    return $query->select('id')
                        ->from('course_chapter')
                        ->where('parent_course_id', $courseId);
                })
                ->with('questions.options')
                ->first();

            return $quiz;

        } catch (ModelNotFoundException $e) {
            throw new QuizNotFoundException();
        }
    }
}
