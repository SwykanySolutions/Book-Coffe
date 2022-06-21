<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{

    private $user;

    public function __construct(UserService $user)
    {
        $this->user = $user;
        $this->middleware('auth:sanctum')->only('update', 'destroy', 'me');
    }

    public function index()
    {
        return $this->user->getAllUsers();
    }

    public function store(CreateUserRequest $request)
    {
        return $this->user->createUser($request->all(), $request->header('User-Agent'));
    }

    public function show($name, $tag)
    {
        return $this->user->getUserbyTag($name, $tag);
    }

    public function me()
    {
        return $this->user->getUserbyAuth();
    }

    public function update(UpdateUserRequest $request)
    {
        return $this->user->updateUser($request);
    }

    public function destroy()
    {
        $this->user->deleteUser();
    }
}
