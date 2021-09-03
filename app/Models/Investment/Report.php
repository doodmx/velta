<?php

namespace App\Models\Investment;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'report';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'investment_id',
        'file',
        'note',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'investment_id' => 'integer',
        'file'          => 'string',
        'note'          => 'string',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
}
