<?php

namespace App\Repositories\Blog;

use DB;
use App\Models\Blog\Blog;
use App\Interfaces\Blog\BlogWebInterface;
use App\Exceptions\Blog\BlogNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogWebRepository implements BlogWebInterface
{
    protected $blog;

    public function __construct()
    {
        $this->blog = app(Blog::class)->make();


    }

    public function paginatePublished($rowsPerPage, $filter)
    {
        return $this->blog
            ->published()
            ->recentPosts()
            ->when(!empty($filter), function ($query) use ($filter) {


                $typeOfSearch = array_keys($filter)[0];
                $searchValue = $filter[$typeOfSearch];

                switch ($typeOfSearch) {
                    case 'category' :
                        return $query->ofCategory($searchValue);
                    case 'tag' :
                        return $query->ofTag($searchValue);
                    case 'querySearch':
                        return $query->ofQuerySearch($searchValue);

                }
            })
            ->with('seo')
            ->paginate($rowsPerPage);
    }

    public function oldPublishedPosts($limit)
    {
        return $this->blog
            ->published()
            ->oldPosts()
            ->limit($limit)
            ->with('seo')
            ->get();
    }

    public function showBySlug($slug)
    {

        try {

            return  $this->blog
                ->published()
                ->whereHas('seo', function ($query) use ($slug) {
                    return $query->where('slug->' . app()->getLocale(), $slug);
                })
                ->with('seo')
                ->firstOrFail();




        } catch (ModelNotFoundException $e) {

            throw new BlogNotFoundException();
        }


        return $blog;


    }


    public function relatedPosts($blog, $limit)
    {


        $tags = $blog->tags->pluck('id')->all();
        $categories = $blog->categories->pluck('id')->all();


        $relatedPosts = $this->blog
            ->published()
            ->recentPosts()
            ->relatedPosts($blog->id, $categories, $tags)
            ->limit($limit)
            ->with('seo')
            ->get();

        return $relatedPosts;
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
