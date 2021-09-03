<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasTranslations, SoftDeletes;
    public $translatable = ['tag'];


    protected $table = 'tag';

    protected $fillable = [
        'tag'
    ];

    protected $casts = [
        'tag' => 'string'
    ];


    /*----- SCOPES -----*/


    public function scopeByLocale($query)
    {
        return $query->where('tag->' . app()->getLocale(), '<>', '');

    }

    public function scopeAll($query)
    {

        return $query->withTrashed();

    }


    public function scopeDeleted($query)
    {
        return $query->onlyTrashed();
    }


}
