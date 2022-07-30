<?php

namespace App\Repositories\Contracts;

interface SearchRepositoryInterface
{
    public function searchManga(string $query);
    public function searchUser(string $query);
    public function searchCategory(string $query);
    public function searchFormat(string $query);
    public function searchPeople(string $query);
    public function searchStatus(string $query);
}
