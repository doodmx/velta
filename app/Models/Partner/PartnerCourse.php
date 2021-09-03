<?php

namespace App\Models\Partner;

use App\Models\User\User;
use App\Models\Course\Course;
use App\Models\Course\CourseDoubt;
use App\Interfaces\Partner\Resource;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PartnerCourse extends Model implements Resource
{

    use HasTranslations;

    protected $table = 'partner_course';

    public $translatable = ['comment'];

    protected $fillable = [
        'partner_id',
        'course_id',
        'approval_certificate',
        'last_chapter',
        'chapter_progress',
        'rate',
        'comment'
    ];


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function doubts()
    {
        return $this->hasMany(CourseDoubt::class, 'course_id', 'id');
    }


    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id', 'id')->withTrashed();
    }

    public function progress()
    {
        return $this->hasMany(CourseProgress::class, 'partner_course_id', 'id');
    }

    public function enable($data)
    {

        return $this->create([
            'partner_id' => $data['partner_id'],
            'course_id'  => $data['resource_id']
        ]);

    }

}
