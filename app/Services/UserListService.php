<?php

namespace App\Services;

use App\Repositories\Contracts\UserListRepositoryInterface;
use App\Repositories\Contracts\MangaChapterRepositoryInterface;
use Illuminate\Http\Request;

class UserListService
{
    private $user_list;
    private $chapters;

    public function __construct(UserListRepositoryInterface $user_list, MangaChapterRepositoryInterface $chapters)
    {
        $this->user_list = $user_list;
        $this->chapters = $chapters;
    }

    public function create(Request $request) 
    {
        $user = auth()->user();
        $chapters = $this->chapters->getAllChapeterbyMangaIdNoPaginate($request->id);
        if(count($chapters) > 0 ? (float)$chapters[0]->chapter >= (float)$request->number : 0 >= (float)$request->number)
        {
            $lists = $this->user_list->getAllByUserId($user->id);
            foreach($lists as $list)
            {
                if($list->manga_over_view_id == $request->id)
                {
                    abort(403);
                }
            }
            return $this->user_list->create($user->id, $request->id, $request->number);
        }
        abort(403);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $list = $this->user_list->getById($request->id);
        if($list->user_id == $user->id)
        {
            $chapters = $this->chapters->getAllChapeterbyMangaIdNoPaginate($list->manga_over_view_id);
            if(count($chapters) > 0 ? (float)$chapters[0]->chapter >= (float)$request->number : 0 >= (float)$request->number) {
                $this->user_list->update($list, $request->number);
                return $this->user_list->getById($request->id);
            }
        }
        abort(403);
    }

    public function getUserList(int $id)
    {
        return $this->user_list->getAllByUserIdPaginate($id);
    }

    public function getOneList(int $id)
    {
        $user = auth()->user();
        return $this->user_list->getByMangaIdandUser($user->id, $id);
    }

    public function delete(int $id)
    {
        $user = auth()->user();
        $list = $this->user_list->getById($id);
        if($list == null)
        {
            abort(404);
        }
        if($list->user_id == $user->id)
        {
            return $this->user_list->delete($list);
        }
        abort(403);
    }
}