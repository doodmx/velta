<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = 'blog_category';

    protected $fillable = [
        'blog_id',
        'category_id'
    ];

    protected $casts = [
        'blog_id' => 'integer',
        'category_id' => 'integer'
    ];

    public function blog(){
        return $this->belongsTo(Blog::class);
    }

}
