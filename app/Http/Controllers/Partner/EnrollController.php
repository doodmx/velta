<?php

namespace App\Http\Controllers\Partner;

use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Quiz\QuizInterface;
use App\Interfaces\Partner\EnrollInterface;
use App\Http\Requests\Partner\CreateReviewRequest;
use App\Http\Requests\Partner\ShowEnrollQuizRequest;
use App\Http\Requests\CreatePartnerQuizStoreRequest;
use App\Interfaces\Partner\PartnerQuizScoreInterface;

class EnrollController extends Controller
{


    private $enrolls, $quizzes, $quizScores;

    public function __construct(EnrollInterface $enrollsContract, QuizInterface $quizContract, PartnerQuizScoreInterface $partnerQuizScore)
    {
        $this->enrolls = $enrollsContract;
        $this->quizzes = $quizContract;
        $this->quizScores = $partnerQuizScore;

    }


    public function addFreePartner($id, Request $request)
    {

        $this->enrolls->addPartner($id, auth()->user()->id);
        $request->session()->flash('enroll_success', 'Te has inscrito exitosamente al curso.');

        return redirect()->route('web.enrolls');
    }


    public function showLearningCourses()
    {

        $enrolls = $this->enrolls->showLearningCourses(auth()->user()->id);

        return view('partner.courses.learning', [
            'enrolls' => $enrolls
        ]);

    }

    public function showLearningCourse($id)
    {

        $enroll = $this->enrolls->showLearningCourse($id);

        return view('partner.courses.learn', [
            'enroll' => $enroll
        ]);
    }

    public function map($id)
    {
        $enroll = $this->enrolls->showLearningCourse($id);

        return view('partner.courses.map', [
            'enroll' => $enroll
        ]);
    }

    public function setChapterAsDone($enrollId, $chapterId)
    {
        $enroll = $this->enrolls->chapterIsDone($enrollId, $chapterId);

        return response()->json(['enroll' => $enroll], 201);

    }

    public function setChapterAsPendant($enrollId, $chapterId)
    {
        $enroll = $this->enrolls->chapterIsPendant($enrollId, $chapterId);
        return response()->json(['enroll' => $enroll], 200);

    }

    public function postReview($id, CreateReviewRequest $request)
    {

        $this->enrolls->addReview($id, $request->all());
        $request->session()->flash('learning_success', __('courses/review.regards'));

        return redirect()->route('web.enrolls');

    }

    public function showQuiz($id, ShowEnrollQuizRequest $request)
    {

        return view('partner.courses.quiz', ['quiz' => $request->quiz]);

    }

    public function postQuiz(CreatePartnerQuizStoreRequest $request)
    {

        $enrollId = $request->segment(2);
        $data = $request->all();


        $pdfData = [
            'partner' => auth()->user()->profile->lastname . ' ' . auth()->user()->profile->name,
            'course'  => $request->quiz->chapter->course->name
        ];

        $certificateName = auth()->user()->profile->lastname . '_' . $request->quiz->chapter->course->name;
        $partner = clean_file_name($certificateName) . '.pdf';

        $pdf = PDF::loadView('formats.certificate', $pdfData)
            ->setPaper('letter', 'landscape');
        $pdf->save(storage_path('app/public/certificates/') . $partner);


        $data['quiz_score'] = array_merge(
            ['partner_id' => auth()->user()->id],
            $data['quiz_score']
        );


        $this->quizScores->store($data);
        $enroll = $this->enrolls->setCourseCertificate($enrollId, 'storage/certificates/' . $partner);

        return response()->json(['certificate' => $enroll->approval_certificate], 201);

    }

}
