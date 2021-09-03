<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\DataTables\CourseTypeDataTable;
use App\Interfaces\Helpers\StorageInterface;
use App\Interfaces\Course\CourseTypeInterface;
use App\Http\Requests\Course\CreateCourseTypeRequest;
use App\Http\Requests\Course\UpdateCourseTypeRequest;

class CourseTypeController extends Controller
{

    private $courseTypes, $files;

    public function __construct(CourseTypeInterface $courseTypeContract, StorageInterface $storageContract)
    {

        $this->courseTypes = $courseTypeContract;
        $this->files = $storageContract;

    }

    public function index(CourseTypeDataTable $courseTypeDataTable)
    {

        return $courseTypeDataTable->render('admin.courses.course_types.index');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore($id)
    {

        $this->courseTypes->restore($id);

        return response()->json(['message' => 'Categoría restaurado correctamente'], 200);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {

        $this->courseTypes->delete($id);


        return response()->json(null, 204);

    }


    public function create()
    {
        return view('admin.courses.course_types.create');
    }

    public function store(CreateCourseTypeRequest $request)
    {

        $data = $request->all();

        $imagePath = $this->files->save('course_types/', $request->file('course_type')['image']);
        $data['course_type']['image'] = $imagePath;


        $this->courseTypes->create($data);

        return response()->json(['message' => 'Categoría creada correctamente'], 201);
    }

    public function edit($id)
    {
        $courseType = $this->courseTypes->show($id);

        return view('admin.courses.course_types.edit')
            ->with('courseType', $courseType);
    }

    public function update($id, UpdateCourseTypeRequest $request)
    {
        $data = $request->all();
        $files = $request->allFiles();

        if (!empty($files)) {

            $imagePath = $this->files->save('course_types/', $request->file('course_type')['image']);
            $data['course_type']['image'] = $imagePath;
        }


        $this->courseTypes->update($id, $data);
        return response()->json(['message' => 'Categoría actualizada  correctamente', 'redirect' => route('course_types.index')], 200);
    }


}
