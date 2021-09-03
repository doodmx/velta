<?php

namespace App\Http\Controllers\User;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\User\RoleInterface;
use App\Http\Requests\User\CreateRoleRequest;
use App\Http\Requests\User\UpdateRoleRequest;


class RoleController extends Controller
{
    protected $roles;

    public function __construct(RoleInterface $roleContract)
    {
        $this->roles = $roleContract;
    }


    public function index(RoleDataTable $roleDataTable)
    {
        return $roleDataTable->render('admin.roles.index');
    }


    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(CreateRoleRequest $request)
    {

        $role = $this->roles->create($request->all());

        return response()->json($role, 201);
    }

    public function show($id)
    {

        $role = $this->roles->show($id);





        return view('admin.roles.edit', [
            'role' => $role
        ]);

    }

    public function update($id, UpdateRoleRequest $request)
    {

        $role = $this->roles->update($id, $request->all());

        return response()->json($role, 200);
    }


    public function restore($id)
    {

        $role = $this->roles->restore($id);

        return response()->json($role, 200);
    }

    public function delete($id)
    {

        $this->roles->delete($id);

        return response()->json(null, 204);
    }

}
