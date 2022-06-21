<?php

namespace App\Repositories\Contracts;

interface SearchRepositoryInterface
{
    public function searchManga(string $query);
    public function searchUser(string $query);
}
