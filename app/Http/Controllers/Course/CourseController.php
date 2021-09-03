<?php

namespace App\Http\Controllers\Course;

use App\DataTables\CourseDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\Course\CourseInterface;
use App\Interfaces\Course\ChapterInterface;
use App\Interfaces\Helpers\StorageInterface;
use App\Http\Requests\Course\CreateCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;

class CourseController extends Controller
{

    private $courses, $chapters;

    public function __construct(CourseInterface $courseContract, ChapterInterface $chapterContract)
    {
        $this->chapters = $chapterContract;
        $this->courses = $courseContract;


    }

    public function index(CourseDataTable $courseDataTable)
    {

        return $courseDataTable->render('admin.courses.index');
    }


    public function restore($id)
    {

        $this->courses->restore($id);

        return response()->json(['message' => 'Curso restaurado correctamente'], 200);

    }


    public function delete($id)
    {

        $this->courses->delete($id);

        return response()->json(null, 204);

    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(CreateCourseRequest $request, StorageInterface $files)
    {
        $data = $request->all();
        $imagePath = $files->save('courses/', $request->file('course')['thumbnail']);
        $data['course']['thumbnail'] = $imagePath;

        $this->courses->create($data);


        return response()->json(['message' => 'Curso creado correctamente'], 200);
    }

    public function edit($id)
    {

        $course = $this->courses->show($id);
        $courseType = $course->categories->map(function ($cat) {
            return $cat['id'];
        });


        return view('admin.courses.edit')
            ->with('course', $course)
            ->with('courseType', $courseType);
    }

    public function update($id, UpdateCourseRequest $request, StorageInterface $filesContract)
    {

        $data = $request->all();
        $files = $request->allFiles();

        if (!empty($files)) {

            $imagePath = $filesContract->save('courses/', $request->file('course')['thumbnail']);
            $data['course']['thumbnail'] = $imagePath;
        }

        $this->courses->update($id, $data);

        return response()->json(['message' => 'Curso actualizado correctamente', 'redirect' => route('courses.index')], 200);
    }
}
