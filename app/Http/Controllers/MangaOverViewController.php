<?php

namespace App\Http\Controllers;

use App\Services\MangaOverViewService;
use App\Http\Requests\Manga\CreateMangaOverViewRequest;

class MangaOverViewController extends Controller
{

    private $manga;

    public function __construct(MangaOverViewService $manga)
    {
        $this->manga = $manga;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function index()
    {
        return $this->manga->getAllManga();
    }

    public function store(CreateMangaOverViewRequest $request)
    {
        return $this->manga->createManga($request);
    }

    public function show($id)
    {
        return $this->manga->getMangabyId($id);
    }
}
