<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PermissionUserRequest;
use App\Http\Requests\Admin\ManagerPermissionRequest;
use App\Http\Controllers\Controller;
use App\Services\AdminUserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(AdminUserService $userService)
    {
        $this->userService = $userService;
    }

    public function update_permission(PermissionUserRequest $request, $id)
    {
        return $this->userService->update_permission($request->all(), $id);
    }

    public function manager_permisions(ManagerPermissionRequest $request, $id)
    {
        return $this->userService->update_manager_permision($request, $id);
    }
}
