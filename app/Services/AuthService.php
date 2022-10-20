<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = auth()->user();
            if($user->owner)
            {
                $user['front_token'] = env('SECRET_TOKEN_FRONT');
            }
            return $user;
        }

        abort(401);
    }

    public function loginToken(Request $request)
    {
        $user = $this->userRepository->getUserbyEmail($request->email);
        if (!$user) {
            return abort(404);
        }
        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken($request->header('User-Agent'));
            $user['token'] = $token->plainTextToken;
            if($user->owner)
            {
                $user['front_token'] = env('SECRET_TOKEN_FRONT');
            }
            return $user;
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }

    public function logOutCurrent(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function logOut(int $id)
    {
        auth()->user()->tokens()->where('id', $id)->delete();
    }

    public function logoutSession(Request $request)
    {
        $request->session()->invalidate();
    }

    public function logOutAll()
    {
        auth()->user()->currentAccessToken()->delete();
    }

}
