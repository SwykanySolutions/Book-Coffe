<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AuthUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    private $user;

    public function __construct(User $user)
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
        $user = $this->user->where('email', $request->email)->first();
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

    public function destroy($id)
    {
        auth()->user()->tokens()->where('id', $id)->delete();
    }

    public function destroy_all()
    {
        auth()->user()->currentAccessToken()->delete();
    }
}
