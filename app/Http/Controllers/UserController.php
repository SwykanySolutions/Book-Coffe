<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('auth:sanctum')->only('update', 'destroy');
    }

    public function index()
    {
        return $this->user->paginate(20);
    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->user->create($request->all());
        $user = $this->user->find($user->id);
        $user['token'] = $user->createToken($request->header('User-Agent'))->plainTextToken;
        return $user;
    }

    public function show($name, $tag)
    {
        $user = $this->user->where('name', $name . '#' . $tag)->first();
        if(!$user){
             return abort(404);
        }
        return $user;
    }

    public function update(UpdateUserRequest $request)
    {
        $user = auth()->user();
        $user_name = $user->name;
        $infos = $request->all();
        if($profile_photo = $request->file('profile_photo')){
            if (Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $infos['profile_photo'] = $profile_photo->store('profiles_photos', 'public');
        }
        if($background_photo = $request->file('background_photo')){
            if (Storage::disk('public')->exists($user->background_photo)) {
                Storage::disk('public')->delete($user->background_photo);
            }
            $infos['background_photo'] = $background_photo->store('backgrounds_photos', 'public');
        }
        if($name = $request->name) $user_name = $name . '#' . explode('#', $user_name)[1];
        if($tag = $request->tag) $user_name = explode('#', $user_name)[0] . '#' . $tag;
        $infos['name'] = $user_name;
        $user->update($infos);
        return $this->user->find($user->id);
    }

    public function destroy()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        $deleted = $this->user->destroy($user->id);
        if(!$deleted){
            return abort(500);
        }
    }
}
