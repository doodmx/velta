<?php

namespace App\Repositories;

use DB;
use App\Models\Partner\PartnerCourse;
use Illuminate\Database\QueryException;
use App\Interfaces\Partner\EnrollInterface;
use App\Interfaces\Course\ChapterInterface;
use App\Exceptions\Helpers\DatabaseException;
use App\Exceptions\Partner\EnrollNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EnrollRepository implements EnrollInterface
{

    protected $enroll, $chapters;

    public function __construct(ChapterInterface $chapterContract)
    {

        $this->enroll = app(PartnerCourse::class);
        $this->chapters = $chapterContract;
    }


    public function addPartner($courseId, $partnerId)
    {

        try {

            $enroll = $this->enroll->create([
                'course_id'  => $courseId,
                'partner_id' => $partnerId,
            ]);

            return $enroll;


        } catch (QueryException $e) {
            throw new DatabaseException();
        }


    }


    public function courseIsCompleted($id)
    {

        try {

            $enroll = $this->enroll->findOrFail($id);

            $isCompleted = intval($enroll->chapter_progress) === 100;

            return [
                'course'    => $enroll->course_id,
                'completed' => $isCompleted
            ];

        } catch (ModelNotFoundException $e) {
            throw new EnrollNotFoundException();
        }
    }

    public function showLearningCourses($partnerId)
    {

        $enrolls = $this->enroll
            ->where('partner_id', $partnerId)
            ->with(['course' => function ($query) {
                $query->whereNull('course.deleted_at');
            }])
            ->orderBy('partner_course.created_at', 'desc')
            ->get();


        return $enrolls;
    }

    public function showLearningCourse($enrollId)
    {

        try {


            $enroll = $this->enroll
                ->with([
                    'course',
                    'course.instructor.profile',
                    'course.chapters' => function ($query) {
                        return $query->select('id', 'parent_course_id')->where('title', 'Root')->first();
                    },
                    'progress'
                ])
                ->findOrFail($enrollId);

            $doneChapters = $enroll->progress->toArray();

            $chapters = $this->chapters->showChapters($enroll->course->id, $enroll->course->chapters[0]->id, 1);

            foreach ($chapters as $chapter) {


                if (!empty($chapter->video_link)) {
                    $chapterIsDone = array_search($chapter->id, array_column($doneChapters, 'course_chapter_id')) !== false;
                    $chapter->is_done = $chapterIsDone;
                }


                foreach ($chapter->nodes as $node) {
                    $nodeIsDone = array_search($node->id, array_column($doneChapters, 'course_chapter_id')) !== false;
                    $node->is_done = $nodeIsDone;
                }
            }

            $enroll->course->chapters_tree = $chapters;


            return $enroll;

        } catch (ModelNotFoundException $e) {

            throw new EnrollNotFoundException();
        }

    }

    public function updateCourseProgress($enroll)
    {
        $totalChapters = $enroll->course->chapters()
            ->where('video_link', '<>', null)
            ->where('title', '<>', 'Root')
            ->count();


        $totalDoneChapters = $enroll->progress()->count();
        $progress = number_format(($totalDoneChapters / $totalChapters) * 100, 2, '.', '');

        $enroll->update(['chapter_progress' => $progress]);

    }

    public function chapterIsDone($enrollId, $chapterId)
    {


        try {

            DB::beginTransaction();

            $enroll = $this->enroll->findOrFail($enrollId);
            $enroll->progress()->create(['course_chapter_id' => $chapterId]);
            $this->updateCourseProgress($enroll);

            DB::commit();

            return $enroll;


        } catch (ModelNotFoundException $e) {
            throw new EnrollNotFoundException();
        } catch (QueryException $e) {
            throw new DatabaseException();
        }
    }

    public function chapterIsPendant($enrollId, $chapterId)
    {

        try {

            DB::beginTransaction();

            $enroll = $this->enroll->findOrFail($enrollId);
            $enroll->progress()->where('course_chapter_id', $chapterId)->delete();
            $this->updateCourseProgress($enroll);

            DB::commit();

            return $enroll;


        } catch (ModelNotFoundException $e) {
            throw new EnrollNotFoundException();
        }
    }

    public function setCourseCertificate($enrollId, $certificate)
    {

        try {
            $enroll = $this->enroll->findOrFail($enrollId);
            $enroll->approval_certificate = $certificate;
            $enroll->save();

            return $enroll;


        } catch (ModelNotFoundException $e) {

            throw new EnrollNotFoundException();
        }

    }

    public function addReview($enrollId, $data)
    {

        try {

            DB::beginTransaction();

            $enroll = $this->enroll->findOrFail($enrollId);

            $enroll->rate = $data['rate'];
            $enroll->comment = $data['comment'];

            $enroll->save();

            $avgRate = $this->enroll->select(DB::raw('ROUND(SUM(rate)/COUNT(rate),2) as rate'))
                ->where('course_id', $enroll->course_id)
                ->get();

            $enroll->course()
                ->update(['average_rate' => $avgRate[0]->rate]);

            DB::commit();


        } catch (ModelNotFoundException $e) {

            throw new EnrollNotFoundException();
        }
    }
}
