<?php

namespace App\Http\Controllers\Quiz;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Quiz\QuestionOptionInterface;

class QuestionOptionController extends Controller
{

    private $options;

    public function __construct(QuestionOptionInterface $questionOptionContract)
    {
        $this->options = $questionOptionContract;
    }


    public function delete(Request $request)
    {

        $id = $request->segment(10);

        $this->options->delete($id);


        return response()->json(null, 204);
    }
}
