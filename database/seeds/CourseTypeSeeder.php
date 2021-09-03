<?php

use App\Models\Course\CourseType;
use App\Models\Course\CourseTypeSeo;
use Illuminate\Database\Seeder;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(CourseType::class, 5)->create()->each(function($courseType){
            $courseType->seo()->create(factory(CourseTypeSeo::class)->make()->toArray());

        });

    }
}
