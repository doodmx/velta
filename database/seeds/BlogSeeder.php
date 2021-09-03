<?php

use App\Models\Blog\Tag;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogSeo;
use App\Models\Blog\Category;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $totalCategories = Category::get()->count();
        $totalTags = Tag::get()->count();

        factory(Blog::class, 20)->create()->each(function ($blog) use ($totalCategories, $totalTags) {


            $blog->seo()->create(factory(BlogSeo::class)->make()->toArray());
            $blog->categories()->sync([random_int(1, $totalCategories)]);

            $tags = Tag::limit(random_int(1, $totalTags))->get()->pluck('id')->all();
            $blog->tags()->sync($tags);

        });

    }
}
