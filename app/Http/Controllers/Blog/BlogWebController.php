<?php

namespace App\Http\Controllers\Blog;

use App\Traits\SEOPageMeta;
use Illuminate\Http\Request;
use App\Interfaces\Blog\TagInterface;
use App\Http\Controllers\Controller;
use App\Interfaces\Blog\BlogWebInterface;
use App\Interfaces\Blog\CategoryInterface;


class BlogWebController extends Controller
{

    private $blogs, $tags, $categories;

    use SEOPageMeta;


    public function __construct(TagInterface $tagContract, CategoryInterface $categoryContract, BlogWebInterface $blogContract)
    {
        $this->blogs = $blogContract;

        $this->categories = $categoryContract->allActive();
        $this->tags = $tagContract->allActive();

        view()->share('categories', $this->categories);
        view()->share('tags', $this->tags);

    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {


        $filter = $request->all();
        $blogs = $this->blogs->paginatePublished(6, $filter);
        $oldPosts = $this->blogs->oldPublishedPosts(3);


        $this->setPageTags([
            'title'       => 'Blog',
            'description' => __('web.blog.subtitle'),
            'keywords'    => array_merge(
                $this->tags->pluck('tag')->all(),
                $this->categories->pluck('category')->all()
            ),
            'separator'   => '|',
            'url'         => url($request->path()),
            'image'       => 'https://libertex.org/sites/lbxorg/files/1192721767_1.jpg'
        ]);

        $blogs->appends($request->except('page'))->links();


        $filterValue = null;
        $queryingPage = array_key_exists('page', $filter);

        if (!empty($filter) && !$queryingPage) {
            $filterValue = $filter[array_keys($filter)[0]];
        }


        return view('web.blog.index', [
            "blogs"    => $blogs,
            "oldPosts" => $oldPosts
        ])
            ->with(['filter' => $filterValue]);

    }


    public function show($slug, Request $request)
    {
        $title = urldecode($slug);
        $blog = $this->blogs->showBySlug($title);

        $relatedPosts = $this->blogs->relatedPosts($blog, 5);

        $this->setPageTags([
            'title'       => $blog->seo->title,
            'description' => $blog->seo->description,
            'keywords'    => $blog->tags->pluck('tag')->all(),
            'separator'   => $blog->seo->separator,
            'url'         => url($request->path()),
            'image'       => asset('blogs/' . $blog->detail_image)
        ]);


        return view("web.blog.detail", [
            'blog'         => $blog,
            'relatedPosts' => $relatedPosts
        ]);
    }


}
