<?php

namespace App\Models\User;

use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends SpatieRole
{
    use SoftDeletes;

    protected $table = "role";

    protected $fillable = [
        'name',
        'guard_name'
    ];

    protected $casts = [
        'name'       => 'string',
        'guard_name' => 'string'
    ];




    /*----- SCOPES -----*/
    public function scopeAll($query)
    {
        return $query->withTrashed();
    }


    public function scopeDeleted($query)
    {
        return $query->onlyTrashed();
    }


}
