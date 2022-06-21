<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class AdminUserService
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function update_permission(array $request, int $id)
    {
        $user = $this->userRepository->getUserbyId($id);
        return $this->userRepository->updateUser($user, $request);
    }

    public function update_manager_permision(Request $request, int $id)
    {
        $user = $this->userRepository->getUserbyId($id);
        $user->manager_permisions = $request->manager_permisions;
        $user->save();
        return $this->userRepository->getUserbyId($id);
    }

}
