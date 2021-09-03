<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $table = "profile";
    protected $primaryKey = 'user_id';


    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'lastname',
        'birth_date',
        'whatsapp',
        'country_code',
        'photo',
        'id_card',
        'proof_residence',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'user_id'         => 'integer',
        'name'            => 'string',
        'lastname'        => 'string',
        'birth_date'      => 'date',
        'whatsapp'        => 'string',
        'country_code'    => 'string',
        'photo'           => 'string',
        'id_card'         => 'string',
        'proof_residence' => 'string',
        'updated_at'      => 'datetime'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {

        return "{$this->lastname} {$this->name}";
    }
}
