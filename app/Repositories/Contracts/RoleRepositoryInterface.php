<?php

namespace App\Repositories\Contracts;

use \App\Models\Role;

Interface RoleRepositoryInterface
{
    public function getAllRoles();
    public function getRoleById(int $id);
    public function createRole(array $request);
    public function updateRole(int $id, array $request);
    public function updateRolePermissions(int $id, array $permissions);
    public function deleteRole(Role $role);
}
