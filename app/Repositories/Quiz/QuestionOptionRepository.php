<?php

namespace App\Repositories;


use App\Models\Quiz\QuestionOption;
use App\Interfaces\Quiz\QuestionOptionInterface;
use App\Exceptions\Quiz\QuestionOptionNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class QuestionOptionRepository implements QuestionOptionInterface
{
    protected $option;

    public function __construct()
    {
        $this->option = app(QuestionOption::class)->make();

    }


    public function create(array $data)
    {
        $option = $this->option->create($data);
        return $option;
    }

    public function show($id)
    {

        try {

            $option = $this->option->findOrFail($id);
            return $option;

        } catch (ModelNotFoundException $e) {
            throw new QuestionOptionNotFoundException();
        }
    }

    public function update($id, array $data)
    {
        $option = $this->show($id);
        $option->option = $data['option'];
        $option->credits = $data['credits'];
        $option->is_right_one = $data['is_right_one'];
        $option->save();

        return $option;
    }

    public function delete($id)
    {

        $option = $this->show($id);
        $option->delete();

    }

}
