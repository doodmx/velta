<?php

namespace App\Repositories;


use App\Models\Quiz\QuizQuestion;
use App\Interfaces\Quiz\QuizQuestionInterface;
use App\Exceptions\Quiz\QuizQuestionNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class QuizQuestionRepository implements QuizQuestionInterface
{
    protected $question;

    public function __construct()
    {
        $this->question = app(QuizQuestion::class)->make();

    }


    public function create($data)
    {
        $question = $this->question->create($data);

        return $question;
    }

    public function show($id)
    {

        try {

            $question = $this->question->findOrFail($id);

            return $question;

        } catch (ModelNotFoundException $e) {
            throw new QuizQuestionNotFoundException();
        }
    }

    public function update($id, $data)
    {
        $question = $this->show($id);

        $question->name = $data['name'];
        $question->type = $data['type'];
        $question->order = $data['order'];
        $question->credits = $data['credits'];
        $question->save();

        return $question;
    }

    public function delete($id)
    {

        $question = $this->show($id);
        $question->delete();

    }

}
