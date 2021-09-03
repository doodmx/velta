<?php

namespace App\Models\Course;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class CourseDoubt extends Model
{

    protected $table = 'course_doubt';

    protected $fillable = [
        'course_id',
        'partner_id',
        'title',
        'content'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id', 'id')->withTrashed();
    }
}
