<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CourseSeo extends Model
{

    use HasTranslations;

    protected $table = 'course_seo';
    protected $primaryKey = 'course_id';

    public $incrementing = false;

    public $translatable = ['slug', 'title', 'image_alt', 'separator', 'description'];


    protected $fillable = [
        'slug',
        'title',
        'image_alt',
        'separator',
        'description'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id ', 'id');
    }
}
