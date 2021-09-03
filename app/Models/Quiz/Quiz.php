<?php

namespace App\Models\Quiz;

use App\Models\Course\CourseChapter;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quiz extends Model
{

    use HasTranslations;

    protected $table = 'chapter_quiz';
    protected $primaryKey = 'chapter_id';

    public $incrementing = false;

    public $translatable = ['name', 'briefing'];

    protected $fillable = [
        'chapter_id',
        'name',
        'briefing',
        'total_credits',
        'credits_to_approve'
    ];

    protected $casts = [
        'chapter_quiz'       => 'integer',
        'name'               => 'string',
        'briefing'           => 'name',
        'total_credits'      => 'integer',
        'credits_to_approve' => 'integer',
    ];

    public function getLocalizedNameAttribute($value)
    {

        $original = $this->getTranslation('name', 'es');
        if (app()->getLocale() === 'es') {
            return $original;
        }

        $translation = $this->getTranslation('name', app()->getLocale());
        if ($translation === $original) {
            return null;
        }

        return $translation;
    }


    public function getLocalizedBriefingAttribute($value)
    {
        $original = $this->getTranslation('briefing', 'es');
        if (app()->getLocale() === 'es') {
            return $original;
        }

        $translation = $this->getTranslation('briefing', app()->getLocale());
        if ($translation === $original) {
            return null;
        }
        return $translation;
    }


    public function chapter()
    {

        return $this->belongsTo(CourseChapter::class, 'chapter_id', 'id');
    }


    public function questions()
    {

        return $this->hasMany(QuizQuestion::class, 'chapter_quiz_id', 'chapter_id')->orderBy('order', 'asc');
    }
}
