<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    protected $table = 'blog_tag';

    protected $fillable = [
        'blog_id',
        'tag_id'
    ];

    protected $casts = [
        'blog_id' => 'integer',
        'tag_id' => 'integer'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
