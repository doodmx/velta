<?php

namespace App\Models\Course;


use App\Models\Partner\PartnerCourse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class CourseType extends Model
{

    use HasTranslations, SoftDeletes;

    public $translatable = ['name', 'description'];

    protected $table = 'course_type';

    protected $fillable = [
        'name',
        'image',
        'description'
    ];


    public static function rules($id = null)
    {
        $unique = empty($id) ? 'unique:course_type' : 'unique:course_type,name,' . $id . ',id';

        return [
            'course_type.name'            => 'required|' . $unique,
            'course_type.description'     => 'nullable',
            'course_type.image'           => $id == null ? 'required |' : '' . 'mimes:jpeg,bmp,png,gif,jpg',
            'course_type_seo.separator'   => 'required',
            'course_type_seo.slug'        => 'required',
            'course_type_seo.title'       => 'required',
            'course_type_seo.description' => 'required',
            'course_type_seo.image_alt'   => 'required'
        ];
    }

    public static function messages()
    {
        return [
            'course_type.name.unique' => 'El valor del campo Nombre ya está en uso.',
        ];
    }


    /*----- RELATIONSHIPS ----- */

    public function seo()
    {
        return $this->hasOne(CourseTypeSeo::class, 'course_type_id', 'id');
    }


    public function enrolls()
    {

        return $this->hasManyThrough(
            PartnerCourse::class,
            CourseHasType::class,
            'course_type_id',
            'course_id',
            'id',
            'course_id'
        );
    }


    public function doubts()
    {

        return $this->hasManyThrough(
            PartnerCourse::class,
            CourseHasType::class,
            'course_type_id',
            'course_id',
            'id',
            'course_id'
        );
    }


    /*----- SCOPES ----- */


    public function scopeAll($query)
    {
        return $query->withTrashed();
    }

    public function scopeByLocale($query)
    {

        return $query->where('name->' . app()->getLocale(), '<>', '');
    }


    public function scopeDeleted($query)
    {
        return $query->onlyTrashed();
    }

}
