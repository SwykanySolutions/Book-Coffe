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
}
