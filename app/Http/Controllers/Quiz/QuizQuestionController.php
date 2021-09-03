<?php

namespace App\Http\Controllers\Quiz;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Quiz\QuizQuestionInterface;

class QuizQuestionController extends Controller
{

    private $questions;

    public function __construct(QuizQuestionInterface $quizQuestionContract)
    {
        $this->questions = $quizQuestionContract;
    }


    public function delete(Request $request)
    {
        $id = $request->segment(8);

        $this->questions->delete($id);

        return response()->json(null, 204);
    }
}
