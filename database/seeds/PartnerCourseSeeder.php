<?php

use App\Models\Course\Course;
use App\Models\User\User;
use App\Models\Partner\PartnerCourse;
use Illuminate\Database\Seeder;

class PartnerCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $courses = Course::orderBy('id', 'asc')->limit(10)->get();
        $partners = User::get()->reject(function ($user) {
            return !$user->hasRole('Partner');
        });

        foreach ($courses as $courseIndex => $course) {

            foreach ($partners as $partnerIndex => $partner) {

                $rate = [];
                $partnerWithNoReview = $courseIndex % 2 === 0 && $partnerIndex % 2 === 0;

                if ($partnerWithNoReview) {
                    $rate = [
                        'rate'    => null,
                        'comment' => null
                    ];
                }

                $enrollFactory = factory(PartnerCourse::class)->make(
                    array_merge(
                        ['partner_id' => $partner->id],
                        $rate
                    )
                )
                    ->toArray();

                $course->enrolls()->create($enrollFactory);
            }
        }

    }
}
