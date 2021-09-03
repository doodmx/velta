<?php

namespace App\Models\Blog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{


    use HasTranslations, SoftDeletes;

    public $translatable = ['author', 'title', 'extract', 'content'];

    protected $table = 'blog';


    protected $fillable = [
        'author',
        'title',
        'extract',
        'content',
        'detail_image',
        'date_to_publish',
        'time_to_publish',
        'status'
    ];

    protected $casts = [
        'author'       => 'string',
        'title'        => 'string',
        'extract'      => 'string',
        'content'      => 'string',
        'detail_image' => 'string',
        'status'       => 'integer'
    ];

    protected $dates = [
        'date_to_publish',
        'time_to_publish'
    ];




    public static function transformBlogRequest($request)
    {

        $blogRequestData = $request->get('blog');
        $currentDate = Carbon::now();

        $dateToPublish = Carbon::createFromFormat('Y-m-d h:i A', $blogRequestData['date_to_publish'] . ' ' . $blogRequestData['time_to_publish']);
        $blogRequestData['time_to_publish'] = $dateToPublish->format('H:i:s');


        $blogRequestData['status'] = 1;

        if ($dateToPublish->diffInHours($currentDate, false) < 0) {
            $blogRequestData['status'] = 0;
        }

        return $blogRequestData;
    }



    /* ----- RELATIONSHIPS ----- */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function seo()
    {
        return $this->hasOne(BlogSeo::class, 'blog_id', 'id');
    }


    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            BlogTag::class,
            'blog_id',
            'tag_id',
            'id'
        );
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            BlogCategory::class,
            'blog_id',
            'category_id',
            'id'
        );
    }

    /*----- SCOPES ----- */


    public function scopePublished($query)
    {

        return $query->where('blog.status', 1)
            ->where('title->'.app()->getLocale(),'<>','')
            ->with([
                'tags',
                'categories'
            ]);

    }


    public function scopeRecentPosts($query)
    {

        return $query->orderBy('date_to_publish', 'desc');
    }


    public function scopeOldPosts($query)
    {

        return $query->orderBy('date_to_publish', 'asc');
    }


    public function scopeRelatedPosts($query, $id, $categories, $tags)
    {


        return $query->whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('category.id', $categories);
        })
            ->orWhereHas('tags', function ($query) use ($tags) {
                $query->whereIn('tag.id', $tags);
            })
            ->where('blog.id', '<>', $id);


    }

    public function scopeOfQuerySearch($query, $querySearch)
    {
        return $query
            ->where('title->' . app()->getLocale(), 'like', '%' . $querySearch . '%')
            ->orWhere('content->' . app()->getLocale(), 'like', '%' . $querySearch . '%');

    }


    public function scopeOfTag($query, $tag)
    {
        return $query->whereHas('tags', function ($query) use ($tag) {

            $query->where('tag.tag', 'like', '%' . $tag . '%');
        });

    }

    public function scopeOfCategory($query, $category)
    {
        return $query->whereHas('categories', function ($query) use ($category) {

            $query->where('category.category', 'like', '%' . $category . '%');
        });


    }
}

