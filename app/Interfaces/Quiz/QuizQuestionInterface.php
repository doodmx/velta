<?php

namespace App\Interfaces\Quiz;

interface QuizQuestionInterface
{

    public function create($data);

    public function update($id, $data);

    public function show($id);

    public function delete($id);


}
