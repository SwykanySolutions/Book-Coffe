<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateRoleRequest;
use App\Http\Requests\Admin\UpdateRolePermissionRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
        $this->middleware(['auth:sanctum', 'access.control']);
    }

    public function index()
    {
        return $this->roleService->getAllRoles();
    }

    public function store(CreateRoleRequest $request)
    {
        return $this->roleService->createRole($request);
    }

    public function show(int $id)
    {
        return $this->roleService->getRoleById($id);
    }

    public function updatePermissions(int $id, UpdateRolePermissionRequest $request)
    {
        $this->roleService->updateRolePermissions($id, $request);
    }

    public function update(int $id, UpdateRoleRequest $request)
    {
        return $this->roleService->updateRole($id, $request);
    }

    public function destroy(int $id)
    {
        $this->roleService->deleteRole($id);
    }
}
