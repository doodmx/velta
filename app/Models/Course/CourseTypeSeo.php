<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CourseTypeSeo extends Model
{
    use HasTranslations;


    protected $table = 'course_type_seo';
    protected $primaryKey = 'course_type_id';

    public $incrementing = false;

    public $translatable = ['slug', 'title', 'image_alt', 'separator', 'description'];

    protected $fillable = [
        'slug',
        'title',
        'image_alt',
        'separator',
        'description'
    ];

    public function courseType()
    {
        return $this->belongsTo(CourseType::class, 'course_type_id ', 'id');
    }
}
