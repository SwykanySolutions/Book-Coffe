<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SearchService;

class SearchController extends Controller
{
    protected $SearchService;

    public function __construct(SearchService $SearchService)
    {
        $this->SearchService = $SearchService;
    }

    public function show($query)
    {
        return $this->SearchService->search($query);
    }
}
