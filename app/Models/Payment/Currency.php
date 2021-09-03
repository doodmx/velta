<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{

    use SoftDeletes;

    public $table = 'currency';


    public $fillable = [
        'iso_code',
        'description'
    ];


    protected $casts = [
        'id'          => 'integer',
        'iso_code'    => 'string',
        'description' => 'string'
    ];


    public static $rules = [
        'iso_code'    => 'required',
        'description' => 'required'
    ];


}
