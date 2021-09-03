<?php

namespace App\Repositories\User;


use App\Interfaces\User\PermissionInterface;
use App\Models\User\Permission;

class PermissionRepository implements PermissionInterface
{
    protected $permission;

    public function __construct()
    {
        $this->permission = app(Permission::class);
    }


    public function allActive()
    {
        return $this->permission->get();
    }

}
