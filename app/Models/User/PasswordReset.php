<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $primaryKey = 'email';
    public $timestamps = false;


    protected $fillable = [
        'email', 'token', 'created_at'
    ];
}
