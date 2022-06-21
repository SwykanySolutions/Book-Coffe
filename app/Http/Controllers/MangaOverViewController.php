<?php

namespace App\Http\Controllers;

use App\Services\MangaOverViewService;
use App\Http\Requests\Manga\CreateMangaOverViewRequest;

class MangaOverViewController extends Controller
{

    private $mangaOverViewService;

    public function __construct(MangaOverViewService $mangaOverViewService)
    {
        $this->mangaOverViewService = $mangaOverViewService;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function index()
    {
        return $this->mangaOverViewService->getAllManga();
    }

    public function store(CreateMangaOverViewRequest $request)
    {
        return $this->mangaOverViewService->createManga($request);
    }

    public function show($id)
    {
        return $this->mangaOverViewService->getMangabyId($id);
    }
}
