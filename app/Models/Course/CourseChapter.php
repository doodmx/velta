<?php

namespace App\Models\Course;

use App\Models\Partner\CourseProgress;
use App\Models\Quiz\Quiz;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseChapter extends Model
{
    use HasTranslations, SoftDeletes;

    protected $table = 'course_chapter';

    protected $primaryKey = 'id';

    public $translatable = ['translated_title', 'description'];

    protected $fillable = [
        'parent_course_id',
        'title',
        'translated_title',
        'video_link',
        'description',
        'icon',
        'left_node',
        'right_node'
    ];


    public function getOriginalTitleAttribute($value)
    {
        return $this->getTranslation('translated_title', 'es');
    }

    public function getLocalizedTitleAttribute($value)
    {
        $translation = $this->getTranslation('translated_title', app()->getLocale());
        if ($translation === $this->original_title) {
            return null;
        }
        return $translation;
    }

    public function getOriginalDescriptionAttribute($value)
    {
        return $this->getTranslation('description', 'es');
    }

    public function getLocalizedDescriptionAttribute($value)
    {

        $translation = $this->getTranslation('description', app()->getLocale());
        if ($translation === $this->original_description) {
            return null;
        }
        return $translation;
    }


    public function course()
    {
        return $this->belongsTo(Course::class, 'parent_course_id', 'id');
    }


    public function quiz()
    {
        return $this->hasOne(Quiz::class, 'chapter_id', 'id');
    }


    public function progress()
    {
        return $this->hasMany(CourseProgress::class, 'course_chapter_id', 'id');
    }
}
