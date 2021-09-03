<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasTranslations, SoftDeletes;

    public $translatable = ['category'];

    protected $table = 'category';

    protected $fillable = [
        'category'
    ];

    protected $casts = [
        'category' => 'string'
    ];


    /*----- RELATIONSHIPS ----- */
    public function relatedPosts()
    {

        return $this->hasManyThrough(
            Blog::class,
            BlogCategory::class,
            '',
            'id',
            '',
            'blog_id'
        )->where('blog.status', 1)
            ->orderBy('blog.id', 'desc');

    }

    /*----- SCOPES -----*/


    public function scopeByLocale($query)
    {

        return $query->where('category->' . app()->getLocale(), '<>', '');

    }

    public function scopeAll($query)
    {

        return $query->withTrashed();

    }


    public function scopeDeleted($query)
    {
        return $query->onlyTrashed();
    }


}
