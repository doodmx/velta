<?php

namespace App\Interfaces\User;

interface RoleInterface
{


    public function allActive();

    public function paginate($filter);

    public function create($data);

    public function show($id);

    public function update($id, $data);

    public function delete($id);

    public function restore($id);

}
