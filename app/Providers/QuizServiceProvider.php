<?php

namespace App\Providers;


use App\Repositories\QuizRepository;
use App\Interfaces\Quiz\QuizInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\QuizQuestionRepository;
use App\Interfaces\Quiz\QuizQuestionInterface;
use App\Repositories\QuestionOptionRepository;
use App\Interfaces\Quiz\QuestionOptionInterface;


class QuizServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {


        $this->app->bind(QuizQuestionInterface::class, QuizQuestionRepository::class);
        $this->app->bind(QuestionOptionInterface::class, QuestionOptionRepository::class);
        $this->app->bind(QuizInterface::class, function ($app) {
            return new QuizRepository(new QuizQuestionRepository(), new QuestionOptionRepository());
        });


    }
}
