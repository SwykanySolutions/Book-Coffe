<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PermissionUserRequest;
use App\Http\Requests\Admin\ManagerPermissionRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function update_permission(PermissionUserRequest $request, $id)
    {
        $user = $this->user->find($id);
        $user->update($request->all());
        return $this->user->find($id);
    }

    public function manager_permisions(ManagerPermissionRequest $request, $id)
    {
        $user = $this->user->find($id);
        $user->manager_permisions = $request->manager_permisions;
        $user->save();
        return $this->user->find($id);
    }
}
