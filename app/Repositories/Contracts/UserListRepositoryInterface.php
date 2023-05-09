<?php

namespace App\Repositories\Contracts;

use App\Models\UserList;

interface UserListRepositoryInterface
{
    public function create(int $userId, int $mangaId, string $number);
    public function update(UserList $list, string $number);
    public function getById(int $id);
    public function getAllByUserId(int $id);
    public function getByMangaIdandUser(int $userId, int $mangaId);
    public function getAllByUserIdPaginate(int $id);
    public function delete(UserList $list);
}