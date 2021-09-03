<?php

namespace App\Repositories\User;

use DB;
use App\Models\User\Role;
use App\Interfaces\User\RoleInterface;
use Illuminate\Database\QueryException;
use App\Exceptions\Helpers\DatabaseException;
use App\Exceptions\Partner\RoleNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoleRepository implements RoleInterface
{
    protected $role;

    public function __construct()
    {
        $this->role = app(Role::class);
    }


    public function allActive()
    {
        return $this->role->get();
    }

    public function paginate($filter)
    {

        $roles = $this->role->newQuery()
            ->where('name', '<>', 'Super Admin');

        if (isset($filter['role_status'])) {

            if ($filter['role_status'] == 'deleted')
                $roles->deleted();

            if ($filter['role_status'] == 'all')
                $roles->all();
        }
        return $roles;

    }


    public function create($data)
    {

        try {

            DB::beginTransaction();

            $role = $this->role->create($data['role']);
            $role->permissions()->sync($data['permissions']);

            DB::commit();

            return $role;

        } catch (QueryException $exception) {

            DB::rollBack();
            throw new DatabaseException();
        }

        return $role;
    }

    public function show($id)
    {

        try {

            $role = $this->role
                ->withTrashed()
                ->with('permissions')
                ->findOrFail($id);


            return $role;

        } catch (ModelNotFoundException $exception) {

            throw new RoleNotFoundException();
        }
    }

    public function update($id, $data)
    {

        $role = $this->show($id);

        try {

            DB::beginTransaction();

            $role->update($data['role']);
            $role->permissions()->sync($data['permissions']);

            DB::commit();

            return $role;

        } catch (QueryException $exception) {

            DB::rollBack();
            throw new DatabaseException();
        }
    }

    public function restore($id)
    {
        $role = $this->show($id);
        $role->restore();

        return $role;
    }

    public function delete($id)
    {
        $role = $this->show($id);
        $role->delete();
    }
}
