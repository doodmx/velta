<?php

namespace App\Repositories\Course;

use DB;
use App\Models\Course\CourseChapter;
use App\Interfaces\Course\ChapterInterface;
use App\Exceptions\Helpers\DatabaseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\Course\ChapterCourseNotFoundException;
use Illuminate\Database\QueryException;

class ChapterRepository implements ChapterInterface
{
    protected $chapter;

    public function __construct()
    {
        $this->chapter = app(CourseChapter::class);
    }

    public function paginate($filter)
    {
        return $this->chapter->all();
    }

    public function addRoot($courseId)
    {
        return $this->chapter->create([
            'parent_course_id' => $courseId,
            'title'            => 'Root',
            'left_node'        => 1,
            'right_node'       => 2
        ]);
    }

    public function add($data)
    {

        $nodeResult = DB::select('CALL addNodeToCourseChapter(?,?,?,?,?)', [
            $data['parent_node_id'],
            $data['parent_course_id'],
            $data['title'],
            $data['url'],
            $data['icon']
        ]);


        $right = collect($nodeResult[0])['@put_right:=right_node'];
        $chapter = $this->chapter
            ->where('right_node', $right + 1)
            ->where('parent_course_id', $data['parent_course_id'])
            ->first();

        $chapter->update([
            'translated_title' => $data['title'],
            'description'      => $data['description']
        ]);

        $chapter->nodes = $this->showChildren($data['parent_course_id'], $chapter->id);

        return $chapter;
    }

    public function belongsToRightCourse($chapterId, $courseId)
    {

        $chapter = $this->show($chapterId);
        return $chapter->parent_course_id === intval($courseId);

    }


    public function show($id)
    {
        try {

            $chapter = $this->chapter->findOrFail($id);

            return $chapter;

        } catch (ModelNotFoundException $e) {

            throw new ChapterCourseNotFoundException();
        }
    }


    public function showRoot($courseId)
    {
        return $this->chapter
            ->where('parent_course_id', $courseId)
            ->where('title', 'Root')
            ->first();
    }


    public function update($chapterId, $chapterData)
    {


        $chapter = $this->show($chapterId);


        try {

            DB::beginTransaction();


            $chapter->update([
                'translated_title' => $chapterData['title'],
                'video_link'       => $chapterData['url'],
                'description'      => $chapterData['description'],
                'icon'             => value_instead($chapterData, 'icon', $chapter->icon)
            ]);

            $chapter->save();

            DB::commit();

            $chapter->nodes = $this->showChildren($chapter->parent_course_id, $chapter->id);


            return $chapter;
        } catch (\Exception $e) {


            DB::rollBack();
            throw new DatabaseException();
        }
    }


    public function delete($chapterId)
    {
        $chapter = $this->show($chapterId);
        $children = $this->showChildren($chapter->parent_course_id, $chapterId);


        try {

            DB::beginTransaction();

            $children->map(function ($children) {

                $children = $this->show($children->id);
                $children->progress()->delete();
                $children->delete();

            });

            $chapter->delete();
            $chapter->progress()->delete();


            DB::commit();

        } catch (QueryException $exception) {

            DB::rollBack();
            throw new DatabaseException('Ocurrio un error al eliminar el capítulo');

        }


    }


    public function showChapters($courseId, $chapterId, $depth = 1)
    {


        $chaptersFromProcedure = collect(DB::select('CALL getNodesOnCourseChapterByDepth(?,?,?)', [$courseId, $chapterId, $depth]));
        $eloquentChapters = $this->chapter->whereIn('id', $chaptersFromProcedure->pluck('id')->all())->get();


        $eloquentChapters->map(function ($chapter) use ($courseId) {
            $chapter->nodes = $this->showChildren($courseId, $chapter->id);
        });

        return $eloquentChapters;
    }

    public function showChildren($courseId, $chapterId)
    {
        $childrenFromProcedure = collect(DB::select('CALL getAllChildNodesOnCourseChapter(?,?)', [$courseId, $chapterId]));
        $eloquentChildren = $this->chapter
            ->whereIn('id', $childrenFromProcedure->pluck('id')->all())
            ->get();

        return $eloquentChildren;
    }


}
