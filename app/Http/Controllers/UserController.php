<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('auth:sanctum')->only('update', 'destroy', 'me');
    }

    public function index()
    {
        return $this->userService->getAllUsers();
    }

    public function store(CreateUserRequest $request)
    {
        return $this->userService->createUser($request->all(), $request->header('User-Agent'));
    }

    public function show($name, $tag)
    {
        return $this->userService->getUserbyTag($name, $tag);
    }

    public function me()
    {
        return $this->userService->getUserbyAuth();
    }

    public function update(UpdateUserRequest $request)
    {
        return $this->userService->updateUser($request);
    }

    public function destroy()
    {
        $this->userService->deleteUser();
    }
}
