<?php

namespace App\Http\Controllers;

use App\Services\SearchService;

class SearchController extends Controller
{
    protected $SearchService;

    public function __construct(SearchService $SearchService)
    {
        $this->SearchService = $SearchService;
    }

    public function showMangaAndUser($query)
    {
        return $this->SearchService->search($query);
    }

    public function showManga($query)
    {
        return $this->SearchService->searchManga($query);
    }

    public function showStatus($query)
    {
        return $this->SearchService->searchStatus($query);
    }

    public function showFormat($query)
    {
        return $this->SearchService->searchFormat($query);
    }

    public function showCategory($query)
    {
        return $this->SearchService->searchCategory($query);
    }

    public function showPeople($query)
    {
        return $this->SearchService->searchPeople($query);
    }
}
