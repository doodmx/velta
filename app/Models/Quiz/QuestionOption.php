<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionOption extends Model
{

    use HasTranslations, SoftDeletes;

    protected $table = 'question_option';
    protected $primaryKey = 'id';

    public $translatable = ['option'];

    protected $fillable = [
        'quiz_question_id',
        'option',
        'credits',
        'is_right_one'
    ];

    protected $casts = [
        'option'       => 'string',
        'credits'      => 'numeric',
        'is_right_one' => 'boolean'
    ];


    public function getLocalizedOptionAttribute($value)
    {

        $original = $this->getTranslation('option', 'es');
        if (app()->getLocale() === 'es') {
            return $original;
        }

        $translation = $this->getTranslation('option', app()->getLocale());
        if ($translation === $original) {
            return null;
        }

        return $translation;
    }


    public function question()
    {
        return $this->belongsTo(QuizQuestion::class, 'quiz_question_id', 'id');
    }
}
