<?php

namespace App\Repositories\Course;

use DB;
use App\Models\Course\CourseType;
use Illuminate\Database\QueryException;
use App\Exceptions\Helpers\DatabaseException;
use App\Interfaces\Course\CourseTypeInterface;
use App\Exceptions\Course\CourseTypeNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CourseTypeRepository implements CourseTypeInterface
{
    protected $courseType;

    public function __construct()
    {
        $this->courseType = app(CourseType::class);
    }

    public function all()
    {
        return $this->courseType->all();
    }

    public function allActive()
    {
        return $this->courseType
            ->byLocale()
            ->with('seo')
            ->get();
    }

    public function allDeleted()
    {
        return $this->courseType->deleted()->get();
    }

    public function paginate($filter)
    {

        $courseTypes = $this->courseType->newQuery()
            ->select('id', 'name', 'image', 'deleted_at');


        if (isset($filter['course_type_status'])) {

            if ($filter['course_type_status'] == 'deleted')
                $courseTypes->deleted();

            if ($filter['course_type_status'] == 'all')
                $courseTypes->all();
        }

        $courseTypes->groupBy('id');


        return $courseTypes;

    }

    public function create($data)
    {

        try {

            DB::beginTransaction();


            $courseType = $this->courseType->create($data['course_type']);
            $courseType->seo()->create($data['course_type_seo']);

            DB::commit();

            return $courseType;

        } catch (QueryException $e) {

            DB::rollBack();

            throw  new DatabaseException();
        }
    }


    public function show($id)
    {
        try {

            $courseType = $this->courseType->with('seo')->findOrFail($id);

            return $courseType;

        } catch (ModelNotFoundException $e) {

            throw new CourseTypeNotFoundException();
        }

    }

    public function update($id, $data)
    {
        $locale = app()->getLocale();

        $courseType = $this->show($id);
        $data['course_type']['image'] = value_instead($data['course_type'], 'image', $courseType->image);

        try {

            DB::beginTransaction();

            $courseType->update($data['course_type']);
            $seo = $courseType->seo;

            $seo->setTranslation('slug', $locale, $data['course_type_seo']['slug']);
            $seo->setTranslation('title', $locale, $data['course_type_seo']['title']);
            $seo->setTranslation('image_alt', $locale, $data['course_type_seo']['image_alt']);
            $seo->setTranslation('separator', $locale, $data['course_type_seo']['separator']);
            $seo->setTranslation('description', $locale, $data['course_type_seo']['description']);

            $seo->save();

            DB:: commit();

            return $courseType;

        } catch (QueryException $e) {

            throw new DatabaseException();
        }

    }

    public function restore($id)
    {
        try {

            $courseType = $this->courseType->onlyTrashed()->findOrFail($id);
            $courseType->restore();

        } catch (ModelNotFoundException $e) {

            throw new CourseTypeNotFoundException();
        }


    }

    public function delete($id)
    {
        $courseType = $this->show($id);
        $courseType->delete();

    }
}
