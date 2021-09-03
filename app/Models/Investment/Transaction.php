<?php

namespace App\Models\Investment;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $timestamps = false;
    protected $table = 'transaction';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'investment_id',
        'amount',
        'balance',
        'start_date',
        'end_date',
        'type',
        'status',
        'created_at'
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'investment_id' => 'integer',
        'amount'        => 'double',
        'balance'       => 'double',
        'start_date'    => 'date',
        'end_date'      => 'date',
        'type'          => 'string',
        'status'        => 'string',
        'created_at'    => 'datetime'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
}
