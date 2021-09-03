<?php

use App\Models\User\User;
use App\Models\Course\Course;
use App\Models\Course\CourseSeo;
use App\Models\Course\CourseType;
use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = CourseType::get();

        $user = User::first();

        $user->taughtCourses()->createMany(factory(Course::class, 5)->make()->toArray());
        $user->taughtCourses()->createMany(factory(Course::class, 5)->make(['currency_id' => null, 'price' => null])->toArray());


        $user->taughtCourses()->createMany(factory(Course::class, 5)->make()->toArray());
        $user->taughtCourses()->createMany(factory(Course::class, 5)->make(['currency_id' => null, 'price' => null])->toArray());



        $courses = $user->taughtCourses()->get();

        foreach ($courses as $course) {

            $course->seo()->create(factory(CourseSeo::class)->make()->toArray());

            $selectedCategories = $categories->whereIn('id', [1, random_int(1, $categories->count())])->pluck('id')->all();

            $course->categories()->sync($selectedCategories);


        }
    }
}
