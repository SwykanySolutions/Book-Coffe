<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserListRepositoryInterface;
use App\Models\UserList;
use App\Models\User;

class UserListRepository implements UserListRepositoryInterface
{
    protected $user_list;
    protected $user;

    public function __construct(UserList $user_list, User $user)
    {
        $this->user_list = $user_list;
        $this->user = $user;
    }

    public function create(int $userId, int $mangaId, string $number)
    {
        $list = new UserList();
        $list->number = $number;
        $list->user_id = $userId;
        $list->manga_over_view_id = $mangaId;
        $list->save();
        return $list;
    }
    public function update(UserList $list, string $number)
    {
        return $list->update(['number' => $number,]);
    }
    
    public function getById(int $id)
    {
        return $this->user_list->find($id);
    }
    
    public function getAllByUserId(int $id)
    {
        return $this->user_list->where('user_id','=', $id)->get();
    }

    public function getByMangaIdandUser(int $userId, int $mangaId)
    {
        return $this->user_list->where(['user_id' => $userId,'manga_over_view_id' => $mangaId])->first();
    }

    public function getAllByUserIdPaginate(int $id)
    {
        return $this->user_list->where('user_id','=', $id)->with('user', 'manga')->paginate(20);
    }
    
    public function delete(UserList $list)
    {
        $list->delete();
    }
}