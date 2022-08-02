<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->listAllUsers();
    }

    public function createUser(Request $request)
    {
        $user = $this->userRepository->createUser($request->all());
        $user = $this->userRepository->getUserbyId($user->id);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return auth()->user();
        }
    }

    public function createUserToken(array $request, $header)
    {
        $user = $this->userRepository->createUser($request);
        $user = $this->userRepository->getUserbyId($user->id);
        $user['token'] = $user->createToken($header)->plainTextToken;
        return $user;
    }

    public function getUserbyTag(string $name, string $tag)
    {
        $user = $this->userRepository->getUserbyName($name . '#' . $tag);
        if (!$user) {
            return abort(404);
        }
        return $user;
    }

    public function getUserbyAuth()
    {
        return auth()->user();
    }

    public function updateUser(Request $request)
    {
        $user = auth()->user();
        $user_name = $user->name;
        $infos = $request->all();
        if ($profile_photo = $request->file('profile_photo')) {
            $image = str_replace('storage/', '', $user->profile_photo);
            if (Storage::disk('public')->exists($image)) {
                Storage::disk('public')->delete($image);
            }
            $infos['profile_photo'] = $profile_photo->store('profiles_photos', 'public');
        }
        if ($background_photo = $request->file('background_photo')) {
            $image = str_replace('storage/', '', $user->background_photo);
            if (Storage::disk('public')->exists($image)) {
                Storage::disk('public')->delete($image);
            }
            $infos['background_photo'] = $background_photo->store('backgrounds_photos', 'public');
        }
        if ($name = $request->name) {
            $user_name = $name . '#' . explode('#', $user_name)[1];
        }

        if ($tag = $request->tag) {
            $user_name = explode('#', $user_name)[0] . '#' . $tag;
        }

        $infos['name'] = $user_name;
        $this->userRepository->updateUser($user, $infos);
        return $this->userRepository->getUserbyId($user->id);
    }

    public function deleteUser()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        $deleted = $this->userRepository->deleteUser($user->id);
        if (!$deleted) {
            return abort(500);
        }
    }

}
