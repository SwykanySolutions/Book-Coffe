<?php

namespace App\Repositories;

use \App\Repositories\Contracts\RoleRepositoryInterface;
use \App\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function getAllRoles()
    {
        return $this->role->orderBy('position', 'ASC')->get();
    }

    public function getRoleById(int $id)
    {
        return $this->role->with('resources')->find($id);
    }

    public function createRole(array $request)
    {
        return $this->role->create($request);
    }

    public function updateRole(int $id, array $request)
    {
        $role = $this->role->find($id);
        $role->update($request);
        return $this->role->find($id);
    }

    public function updateRolePermissions(int $id, array $permissions)
    {
        $role = $this->role->find($id);
        $role->resources()->sync($permissions);
    }

    public function deleteRole(Role $role)
    {
        $role->delete();
    }
}
