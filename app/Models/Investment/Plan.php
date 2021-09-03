<?php

namespace App\Models\Investment;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes, HasTranslations;

    protected $table = 'plan';

    public $translatable = ['name'];

    protected $fillable = [
        'currency_id',
        'thumbnail',
        'name',
        'min_amount',
        'profit_percentage',
        'liquidity',
        'created_at',
        'updated_at'
    ];


    protected $casts = [
        'currency_id'       => 'integer',
        'thumbnail'         => 'string',
        'name'              => 'string',
        'min_amount'        => 'double',
        'profit_percentage' => 'double',
        'liquidity'         => 'string',
        'is_active'         => 'boolean',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
    ];


    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }


    public function investment()
    {
        return $this->hasMany(Investment::class, 'plan_id', 'id');
    }


}
