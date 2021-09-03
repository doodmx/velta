<?php

namespace App\Models\Partner;

use App\Models\Quiz\QuestionOption;
use Illuminate\Database\Eloquent\Model;

class PartnerQuizReply extends Model
{
    protected $table = 'partner_quizz_reply';

    protected $fillable = [
        'question_option_id'
    ];

    public function option()
    {
        return $this->belongsTo(QuestionOption::class, 'question_option_id', 'id');
    }
}
