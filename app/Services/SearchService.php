<?php

namespace App\Services;

use App\Repositories\Contracts\SearchRepositoryInterface;

class SearchService
{
    protected $SearchRepository;

    public function __construct(SearchRepositoryInterface $SearchRepository)
    {
        $this->SearchRepository = $SearchRepository;
    }

    public function search(string $name)
    {
        $response['mangas'] = $this->SearchRepository->searchManga($name);
        $response['users'] = $this->SearchRepository->searchUser($name);
        return $response;
    }

    public function searchManga(string $name)
    {
        return $this->SearchRepository->searchManga($name);
    }

    public function searchStatus(string $name)
    {
        return $this->SearchRepository->searchStatus($name);
    }

    public function searchPeople(string $name)
    {
        return $this->SearchRepository->searchPeople($name);
    }

    public function searchCategory(string $name)
    {
        return $this->SearchRepository->searchCategory($name);
    }

    public function searchFormat(string $name)
    {
        return $this->SearchRepository->searchFormat($name);
    }

}
