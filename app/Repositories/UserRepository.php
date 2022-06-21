<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function listAllUsers()
    {
        return $this->user->paginate(20);
    }

    public function createUser(array $request)
    {
        return $this->user->create($request);
    }

    public function updateUser(User $user, array $request)
    {
        return $user->update($request);
    }

    public function getUserbyName(string $name)
    {
        return $this->user->where('name', $name)->first();
    }

    public function getUserbyId(int $id)
    {
        return $this->user->find($id);
    }

    public function getUserbyEmail(string $email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function deleteUser(int $id)
    {
        return  $this->user->destroy($id);
    }

}
