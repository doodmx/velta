<?php

namespace App\Models\User;

use App\Models\Course\Course;
use Laravel\Passport\HasApiTokens;
use App\Models\Investment\Investment;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Partner\PartnerResource;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles, SoftDeletes;

    protected $table = "user";


    protected $fillable = [
        'partner_id', 'name', 'email', 'password', 'status', 'notes', 'locale', 'membership'
    ];


    protected $hidden = [
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime'
    ];




    public function enrolls()
    {
        return $this->hasMany(PartnerResource::class, 'partner_id', 'id');
    }

    public function investment()
    {
        return $this->hasOne(Investment::class, 'user_id', 'id');
    }

    public function owner()
    {
        return $this->hasOne(Profile::class, 'user_id', 'partner_id');

    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }


    public function taughtCourses()
    {
        return $this->hasMany(Course::class, 'instructor_id', 'id');
    }


}
