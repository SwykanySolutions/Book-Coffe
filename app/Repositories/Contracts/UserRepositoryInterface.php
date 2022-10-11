<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function listAllUsers();
    public function createUser(array $request);
    public function updateUser(User $user, array $request);
    public function getUserbyName(string $tag);
    public function getUserbyId(int $id);
    public function getUserbyEmail(string $email);
    public function deleteUser(int $id);
    public function updateUserRoles(User $user, array $roles);
}
