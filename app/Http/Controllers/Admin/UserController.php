<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRolesRequest;
use Illuminate\Http\Request;
use \App\Services\UserService;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware(['auth:sanctum', 'access.control']);
    }

    public function updateRoles(int $id, UpdateUserRolesRequest $request)
    {
        $this->userService->updateUserRoles($id, $request);
    }
}
