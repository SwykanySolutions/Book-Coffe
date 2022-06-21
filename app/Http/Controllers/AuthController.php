<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AuthUserRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $user;

    public function __construct(AuthService $user)
    {
        $this->user = $user;
        $this->middleware('auth:sanctum')->only('index', 'destroy_all', 'destroy');
    }

    public function index()
    {
        return auth()->user()->tokens;
    }

    public function store(AuthUserRequest $request)
    {
        return $this->user->login($request);
    }

    public function destroy($id)
    {
        $this->user->logOut($id);
    }

    public function destroy_all()
    {
        $this->user->logOutAll();
    }
}
