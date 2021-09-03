<?php

namespace App\Interfaces\User;

interface UserInterface
{

    public function paginate($filter);

    public function login($credentials);

    public function register($userData, $role);

    public function forgotPassword($user);

    public function logout();

    public function sendLoginResponse();

    public function showById($id);

    public function showByEmail($email);

    public function updateProfile($id, $data);

    public function updateCredentials($id, $data);

    public function changeRole($id, $role);

    public function showAllByRole($role);

    public function delete($id);

}
