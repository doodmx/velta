<?php

namespace App\Interfaces\Quiz;

interface QuestionOptionInterface
{

    public function create(array $data);

    public function show($id);

    public function update($id, array $data);

    public function delete($id);


}
