<?php

namespace App\Services;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserService
{

    protected $userRepository;
    protected $roleRepository;

    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->listAllUsers();
    }

    public function createUser(Request $request)
    {
        $user = $this->userRepository->createUser($request->all());
        $user = $this->userRepository->getUserbyId($user->id);
        $user->roles()->sync([1]);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return auth()->user();
        }
    }

    public function createUserToken(Request $request)
    {
        $user = $this->userRepository->createUser($request->all());
        $user = $this->userRepository->getUserbyId($user->id);
        $user->roles()->sync([1]);
        $user['token'] = $user->createToken($request->header('User-Agent'))->plainTextToken;
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
        $user = auth()->user();
        if($user->owner)
        {
            $user['front_token'] = env('SECRET_TOKEN_FRONT');
        }
        return $user;
    }

    public function updateUser(Request $request)
    {
        $user = auth()->user();
        $user_name = $user->name;
        $infos = $request->all();
        if ($profile_photo = $request->file('profile_photo')) {
            $image = $user->profile_photo;
            if (Storage::disk('s3')->exists($image)) {
                Storage::disk('s3')->delete($image);
            }
            $infos['profile_photo'] = $profile_photo->store('profiles_photos', 's3');
        }
        if ($background_photo = $request->file('background_photo')) {
            $image = $user->background_photo;
            if (Storage::disk('s3')->exists($image)) {
                Storage::disk('s3')->delete($image);
            }
            $infos['background_photo'] = $background_photo->store('backgrounds_photos', 's3');
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

    public function updateUserRoles(int $id, Request $request)
    {
        $user = $this->userRepository->getUserbyId($id);
        $roles = $request->roles;
        $applicant = auth()->user();
        $userRole = $user->roles()->orderBy('position', 'ASC')->get()[0];
        if(!$applicant->owner){
            foreach ($request->roles as $roleId){
                $role = $this->roleRepository->getRoleById($roleId);
                if($role->position <= $userRole->position){
                    abort(403);
                }
            }
            array_push($roles, $userRole->id);
        }
        $this->userRepository->updateUserRoles($user, $roles);
    }
}