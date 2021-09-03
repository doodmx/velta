<?php

namespace App\Models\Course;

use App\Models\Partner\PartnerCourse;
use App\Models\Payment\Currency;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Course extends Model
{


    use HasTranslations, SoftDeletes;


    protected $table = 'course';
    public const  DEFAULT_INSTRUCTOR = 1;
    public $translatable = ['name', 'excerpt', 'description', 'currency_id', 'price'];


    protected $fillable = [
        'instructor_id',
        'name',
        'excerpt',
        'thumbnail',
        'description',
        'total_chapters',
        'average_rate',
        'currency_id',
        'price'
    ];


    /* ----- RELATIONSHIPS -----*/


    public function categories()
    {
        return $this->belongsToMany(
            CourseType::class,
            CourseHasType::class,
            'course_id',
            'course_type_id',
            'id');

    }


    public function chapters()
    {
        return $this->hasMany(CourseChapter::class, 'parent_course_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }


    public function doubts()
    {
        return $this->hasMany(CourseDoubt::class, 'course_id', 'id');
    }

    public function enrolls()
    {
        return $this->hasMany(PartnerCourse::class, 'course_id', 'id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id')->withTrashed();
    }


    public function seo()
    {
        return $this->hasOne(CourseSeo::class, 'course_id', 'id');
    }


    /*-----MUTATORS -----*/

    public function getLocalizedCurrencyAttribute($value)
    {
        $original = $this->getTranslation('currency_id', 'es');

        if (app()->getLocale() == 'es') {
            return $original;
        }

        $translation = $this->getTranslation('currency_id', app()->getLocale());
        if ($translation === $original) {
            return null;
        }
        return $translation;
    }

    public function getLocalizedPriceAttribute($value)
    {
        $original = $this->getTranslation('price', 'es');

        if (app()->getLocale() == 'es') {
            return $original;
        }

        $translation = $this->getTranslation('price', app()->getLocale());
        if ($translation === $original) {
            return null;
        }
        return $translation;
    }


    /*----- SCOPES -----*/


    public function scopeAll($query)
    {
        return $query->withTrashed();
    }


    public function scopeDeleted($query)
    {
        return $query->onlyTrashed();
    }

    public function scopeFree($query)
    {
        return $query->whereNull('currency_id')
            ->whereNull('price');
    }

    public function scopeReviews($query)
    {
        return $query->enrolls()
            ->select('rate', 'comment')
            ->with('partner.profile')
            ->whereNotNull('rate');
    }


    public function scopeRecents($query)
    {
        return $query
            ->withCount(['enrolls' => function ($query) {
                return $query->whereHas('partner', function ($query) {
                    return $query->where('user.locale', app()->getLocale());
                });
            }, 'doubts'])
            ->orderBy('created_at', 'desc');
    }


}
