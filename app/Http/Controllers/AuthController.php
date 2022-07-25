<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AuthUserRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware('auth:sanctum')->only('index', 'destroy_all', 'destroy');
    }

    public function index()
    {
        return $this->authService->getAllAuth();
    }

    public function storeToken(AuthUserRequest $request)
    {
        return $this->authService->loginToken($request);
    }

    public function store(AuthUserRequest $request)
    {
        return $this->authService->login($request);
    }

    public function destroy($id)
    {
        $this->authService->logOut($id);
    }

    public function destroy_all()
    {
        $this->authService->logOutAll();
    }
}
