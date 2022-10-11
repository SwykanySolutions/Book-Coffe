<?php

namespace App\Services;

use App\Repositories\Contracts\ResourceRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleService
{
    protected $roleRepository;
    protected $resourceRepository;

    public function __construct(RoleRepositoryInterface $roleRepository, ResourceRepositoryInterface $resourceRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->resourceRepository = $resourceRepository;
    }

    public function getAllRoles()
    {
        return $this->roleRepository->getAllRoles();
    }

    public function createRole(Request $request)
    {
        $infos = $request->all();
        $roleUser = $this->roleRepository->getRoleById(1);
        $infos['position'] = $roleUser->position;
        $this->roleRepository->updateRole(1,['position' => $roleUser->position + 1]);
        if($request->editable || $request->deletable){
            if(!auth()->user()->owner){
                abort(403);
            }
        }
        return $this->roleRepository->createRole($infos);
    }

    public function updateRole(int $id, Request $request)
    {
        $infos = $request->all();
        if($request->editable || $request->deletable){
            if(auth()->user()->owner){
                abort(403);
            }
        }
        return $this->roleRepository->updateRole($id, $infos);
    }

    public function updateRolePermissions(int $id, Request $request)
    {
        $user = auth()->user();
        $role = $this->roleRepository->getRoleById($id);
        $userRole = $user->roles()->orderBy('position', 'ASC')->get()[0];
        if(!$user->owner){
            foreach ($request->permissions as $permission){
                $resource = $this->resourceRepository->getResourceById($permission);
                if(!$resource){
                    abort(404);
                }
                if($resource->resource == 'admin.role.permissions.update' || $resource->resource == 'admin.role.update' || $resource->resource == 'admin.role.user.update'){
                    abort(403);
                }
            }
        }
        if($role->position > $userRole->position || $user->owner){
            $this->roleRepository->updateRolePermissions($id, $request->permissions);
        } else {
            abort(403);
        }
    }

    public function getRoleById(int $id)
    {
        $role = $this->roleRepository->getRoleById($id);
        if(!$role){
            abort(404);
        }
        return $role;
    }

    public function deleteRole(int $id)
    {
        $role = $this->roleRepository->getRoleById($id);
        if(!$role){
            abort(404);
        } else if($role->deletable){
            $this->roleRepository->deleteRole($role);
        } else {
            abort(403);
        }
    }
}
