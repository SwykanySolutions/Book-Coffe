<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manga\CreateMangaOverViewRequest;
use App\Services\MangaOverViewService;

class MangaOverViewController extends Controller
{

    private $mangaOverViewService;

    public function __construct(MangaOverViewService $mangaOverViewService)
    {
        $this->mangaOverViewService = $mangaOverViewService;
        $this->middleware(['auth:sanctum', 'access.control'])->only('store', 'update', 'destroy');
    }

    public function index()
    {
        return $this->mangaOverViewService->getAllManga();
    }

    public function indexIds()
    {
        return $this->mangaOverViewService->getAllMangaIds();
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
