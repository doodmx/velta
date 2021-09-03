<?php

namespace App\Repositories\Blog;

use DB;
use App\Models\Blog\Blog;
use App\Interfaces\Blog\BlogInterface;
use Illuminate\Database\QueryException;
use App\Exceptions\Helpers\DatabaseException;
use App\Exceptions\Blog\BlogNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogRepository implements BlogInterface
{
    protected $blog;

    public function __construct()
    {
        $this->blog = app(Blog::class)->make();

    }

    public function showAll()
    {
        return $this->blog->published()->with('seo')->get();

    }

    public function paginate($filter)
    {


        $blogs = $this->blog->newQuery()->with('categories');


        if (!empty($filter['category'])) {
            $blogs->whereHas('categories', function ($query) use ($filter) {
                return $query->where('category.id', $filter['category']);
            });

        }

        return $blogs;

    }

    public function store(array $data)
    {


        try {

            DB::beginTransaction();


            $blog = $this->blog->create($data['blog']);
            $blog->categories()->sync([$data['blog']['category_id']]);
            $blog->tags()->sync($data["blog_tag"]);


            $blog->seo()->create($data['blog_seo']);

            DB::commit();

            return $blog;

        } catch (QueryException $e) {

            throw  new DatabaseException();

        }


    }

    public function showById($id)
    {

        try {

            return $this->blog->with(['seo', 'tags', 'categories'])->findOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new BlogNotFoundException();
        }

    }

    public function update($id, array $data)
    {


        $locale = app()->getLocale();
        try {

            DB::beginTransaction();


            $blog = $this->showById($id);
            $data['blog']['detail_image'] = value_instead($data['blog'], 'detail_image', $blog->detail_image);
            $blog->update($data['blog']);


            $blog->categories()->sync([$data['blog']['category_id']]);
            $blog->tags()->sync($data["blog_tag"]);


            $seo = $blog->seo;

            $seo->setTranslation('slug', $locale, $data['blog_seo']['slug']);
            $seo->setTranslation('title', $locale, $data['blog_seo']['title']);
            $seo->setTranslation('image_alt', $locale, $data['blog_seo']['image_alt']);
            $seo->setTranslation('separator', $locale, $data['blog_seo']['separator']);
            $seo->setTranslation('description', $locale, $data['blog_seo']['description']);

            $seo->save();


            DB::commit();

            return $blog;


        } catch (QueryException $e) {

            DB::rollBack();

            throw  new DatabaseException();

        }

    }

    public function publishPostsFromDate($date, $time)
    {

        $this->blog
            ->where('date_to_publish', '<=', $date)
            ->where('time_to_publish', '<=', $time)
            ->update([
                'status' => 1
            ]);

    }


}
