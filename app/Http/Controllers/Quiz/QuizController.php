<?php

namespace App\Http\Controllers\Quiz;

use App\Http\Controllers\Controller;
use App\Interfaces\Quiz\QuizInterface;
use App\Interfaces\Course\CourseInterface;
use App\Interfaces\Course\ChapterInterface;
use App\Http\Requests\ShowCreateQuizRequest;
use App\Http\Requests\Quiz\CreateQuizRequest;
use App\Http\Resources\Quiz\Quiz as QuizResource;

class QuizController extends Controller
{

    private $quizzes, $courseId, $chapterId;

    public function __construct(QuizInterface $quizContract, CourseInterface $courseContract, ChapterInterface $chapterContract)
    {
        $this->quizzes = $quizContract;

        if (request()->segment(3) && request()->segment(5)) {


            $this->courseId = request()->segment(3);
            $this->chapterId = request()->segment(5);


            $course = $courseContract->show($this->courseId);
            $chapter = $chapterContract->show($this->chapterId);

            view()->share('course', $course);
            view()->share('chapter', $chapter);


        }

    }

    public function create(ShowCreateQuizRequest $request)
    {


        $canCreateQuiz = $this->quizzes->canCreateQuiz($this->courseId, $this->chapterId);


        if (!$canCreateQuiz) {
            $request->session()->flash('course_error', 'Sólo puedes crear un cuestionario de certificación por curso');
            return redirect()->route('courses.index', $this->courseId);
        }

        $quizExists = $this->quizzes->checkIfExists($this->chapterId);


        if ($canCreateQuiz && app()->getLocale() !== 'es' && !$quizExists) {
            $request->session()->flash('course_error', 'Debes crear el cuestionario en español.');
            return redirect()->route('courses.index', $this->courseId);
        }

        if ($quizExists) {
            return redirect(route('quiz.show', [$this->courseId, $this->chapterId]));
        }
        return view('admin.quiz.create');
    }


    public function store(CreateQuizRequest $request)
    {

        $this->quizzes->store($this->chapterId, $request->all());

        return response()->json(['message' => 'Cuestionario creado correctamente'], 201);

    }

    public function show(ShowCreateQuizRequest $request)
    {

        if ($request->isJson()) {

            $quiz = $this->quizzes->show($this->chapterId);

            return new QuizResource($quiz);
        }


        return view('admin.quiz.create');

    }

    public function update(CreateQuizRequest $request)
    {

        $quiz = $this->quizzes->update($this->chapterId, $request->all());
        return new QuizResource($quiz);
    }
}
