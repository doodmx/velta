<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizQuestion extends Model
{

    use HasTranslations, SoftDeletes;

    protected $table = 'quiz_question';
    protected $primaryKey = 'id';

    public $translatable = ['name'];

    protected $fillable = [
        'chapter_quiz_id',
        'name',
        'type',
        'credits',
        'order'
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

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'chapter_quiz_id', 'chapter_id');
    }

    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'quiz_question_id', 'id');
    }
}
