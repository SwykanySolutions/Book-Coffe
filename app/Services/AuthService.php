<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthService
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllAuth()
    {
        return auth()->user()->tokens;
    }

    public function login(Request $request)
    {
        $user = $this->userRepository->getUserbyEmail($request->email);
        if(!$user)
        {
            return abort(404);
        }
        if(Hash::check($request->password, $user->password))
        {
            $token = $user->createToken($request->header('User-Agent'));
            $user['token'] = $token->plainTextToken;
            return $user;
        }
        else
        {
            return abort(403,'Unauthorized action.');
        }
    }

    public function logOut(int $id)
    {
        auth()->user()->tokens()->where('id', $id)->delete();
    }

    public function logOutAll()
    {
        auth()->user()->currentAccessToken()->delete();
    }

}