<?php

namespace App\Http\Controllers;

use App\Services\MangaChapterService;
use App\Http\Requests\Manga\CreateMangaChapterRequest;

class MangaChapterController extends Controller
{

    protected $mangaChapterService;

    public function __construct(MangaChapterService $mangaChapterService)
    {
        $this->mangaChapterService = $mangaChapterService;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function index($id)
    {
        return $this->mangaChapterService->getAllChapeterbyMangaId($id);
    }

    public function store(CreateMangaChapterRequest $request)
    {
        return $this->mangaChapterService->createChapterManga($request);
    }

    public function show($id)
    {
        return $this->mangaChapterService->getChapterPages($id);
    }

    public function destroy($id)
    {
        return $this->mangaChapterService->deleteChapter($id);
    }
}
