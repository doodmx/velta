<?php

namespace App\Models\Partner;

use App\Models\Quiz\Quiz;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class PartnerQuizScore extends Model
{
    protected $table = 'partner_quiz_score';

    protected $fillable = [
        'partner_id',
        'chapter_quiz_id',
        'feedback',
        'score',
    ];

    public function partner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'chapter_quiz_id', 'chapter_id');
    }

    public function answers()
    {
        return $this->hasMany(PartnerQuizReply::class, 'quiz_score_id', 'id');
    }
}
