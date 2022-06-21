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
}
