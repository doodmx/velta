<?php

use App\Models\User\User;
use App\Models\Course\Course;
use App\Models\Course\CourseDoubt;
use Illuminate\Database\Seeder;

class CourseDoubtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::get();
        $partners = User::get()->reject(function ($user) {
            return !$user->hasRole('Partner');
        });


        foreach ($courses as $course) {

            foreach ($partners as $partner) {
                $course->doubts()->createMany(factory(CourseDoubt::class,3)->make([
                    'partner_id' => $partner->id
                ])->toArray());
            }

        }
    }
}
