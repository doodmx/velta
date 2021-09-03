<?php

namespace App\Providers;


use App\Interfaces\Blog\TagInterface;
use App\Interfaces\Blog\BlogInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Blog\TagRepository;
use App\Interfaces\Blog\BlogWebInterface;
use App\Repositories\Blog\BlogRepository;
use App\Interfaces\Blog\CategoryInterface;
use App\Repositories\Blog\BlogWebRepository;
use App\Repositories\Blog\CategoryRepository;

class BlogServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {

        $this->app->bind(TagInterface::class, TagRepository::class);
        $this->app->bind(BlogInterface::class, BlogRepository::class);
        $this->app->bind(BlogWebInterface::class, BlogWebRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);

    }
}
