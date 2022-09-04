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

    public function showMangaAndUser($name)
    {
        return $this->SearchService->search($name);
    }

    public function showManga($name)
    {
        return $this->SearchService->searchManga($name);
    }

    public function showStatus($name)
    {
        return $this->SearchService->searchStatus($name);
    }

    public function showFormat($name)
    {
        return $this->SearchService->searchFormat($name);
    }

    public function showCategory($name)
    {
        return $this->SearchService->searchCategory($name);
    }

    public function showPeople($name)
    {
        return $this->SearchService->searchPeople($name);
    }
}
