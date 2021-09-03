<?php

namespace App\Models\Investment;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    protected $table = 'investment';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id',
        'plan_id',
        'currency_id',
        'start_date',
        'end_date',
        'balance',
        'profit_percentage',
        'period_in_years',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'user_id'           => 'integer',
        'plan_id'           => 'integer',
        'currency_id'       => 'integer',
        'start_date'        => 'date',
        'end_date'          => 'date',
        'balance'           => 'double',
        'profit_percentage' => 'double',
        'period_in_years'   => 'integer',
        'status'            => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime'
    ];


    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id','id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'investment_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reports()
    {
        return $this->hasMany(Report::class, 'investment_id', 'id');
    }
}
