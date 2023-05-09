<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\List\UserListCreate;
use App\Http\Requests\User\List\UserListUpdate;
use App\Services\UserListService;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    private $userListService;

    public function __construct(UserListService $userListService)
    {
        $this->userListService = $userListService;
        $this->middleware('auth:sanctum')->only('update', 'destroy', 'store', 'show');
    }

    public function index(int $id)
    {
        return $this->userListService->getUserList($id);
    }

    public function show(int $id)
    {
        return $this->userListService->getOneList($id);
    }

    public function store(UserListCreate $request)
    {
        return $this->userListService->create($request);
    }

    public function update(UserListUpdate $request)
    {
        return $this->userListService->update($request);
    }

    public function destroy(int $id)
    {
        return $this->userListService->delete($id);
    }
}