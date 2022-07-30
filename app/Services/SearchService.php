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

    public function search(string $query)
    {
        $response['mangas'] = $this->SearchRepository->searchManga($query);
        $response['users'] = $this->SearchRepository->searchUser($query);
        return $response;
    }

    public function searchManga(string $query)
    {
        return $this->SearchRepository->searchManga($query);
    }

    public function searchStatus(string $query)
    {
        return $this->SearchRepository->searchStatus($query);
    }

    public function searchPeople(string $query)
    {
        return $this->SearchRepository->searchPeople($query);
    }

    public function searchCategory(string $query)
    {
        return $this->SearchRepository->searchCategory($query);
    }

    public function searchFormat(string $query)
    {
        return $this->SearchRepository->searchFormat($query);
    }

}
