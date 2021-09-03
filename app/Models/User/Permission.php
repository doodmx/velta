<?php

namespace App\Models\User;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends SpatiePermission
{
    use SoftDeletes;

    protected $table = "permissions";

    protected $fillable = [
        'name',
        'description',
        'guard_name',
        'module'
    ];

    protected $casts = [
        'name'         => 'string',
        'description ' => 'string',
        'guard_name'   => 'string',
        'module'   => 'string'
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
