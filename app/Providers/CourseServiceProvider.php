<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Interfaces\Course\CourseInterface;
use App\Interfaces\Course\ChapterInterface;
use App\Repositories\Course\CourseRepository;
use App\Interfaces\Course\CourseWebInterface;
use App\Interfaces\Course\CourseTypeInterface;
use App\Repositories\Course\ChapterRepository;
use App\Repositories\Course\CourseWebRepository;
use App\Repositories\Course\CourseTypeRepository;
use App\Interfaces\Course\CourseTypeWebInterface;
use App\Repositories\Course\CourseTypeWebRepository;


class CourseServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {

        $this->app->bind(CourseInterface::class, function ($app) {
            return new CourseRepository(new ChapterRepository());
        });
        $this->app->bind(CourseWebInterface::class, function ($app) {
            return new CourseWebRepository(new ChapterRepository());
        });

        $this->app->bind(ChapterInterface::class, ChapterRepository::class);
        $this->app->bind(CourseTypeInterface::class, CourseTypeRepository::class);
        $this->app->bind(CourseTypeWebInterface::class, CourseTypeWebRepository::class);


    }
}
