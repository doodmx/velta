<?php

namespace App\Models\Partner;

use DB;
use App\Models\Course\CourseChapter;
use Illuminate\Database\Eloquent\Model;

class CourseProgress extends Model
{
    protected $table = 'course_progress';

    protected $fillable = [
        'partner_course_id',
        'course_chapter_id'
    ];


    public function enroll()
    {
        return $this->belongsTo(PartnerResource::class, 'partner_course_id', 'id');
    }


    public function chapter()
    {
        return $this->belongsTo(CourseChapter::class, 'course_chapter_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($value) {

            DB::statement("ALTER TABLE course_progress  AUTO_INCREMENT = 1 ;");

        });
    }
}
