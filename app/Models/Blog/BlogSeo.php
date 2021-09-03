<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BlogSeo extends Model
{

    use HasTranslations;

    public $translatable = ['slug', 'title', 'image_alt', 'separator', 'description'];

    protected $table = 'blog_seo';
    protected $primaryKey = 'blog_id';

    public $incrementing = false;


    protected $fillable = [
        'separator',
        'slug',
        'title',
        'image_alt',
        'description',

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id ', 'id');
    }

}
