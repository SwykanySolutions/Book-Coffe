<?php

namespace App\Http\Controllers;

use App\Services\MangaChapterService;
use App\Http\Requests\Manga\CreateMangaChapterRequest;

class MangaChapterController extends Controller
{

    protected $chapterManga;

    public function __construct(MangaChapterService $chapterManga)
    {
        $this->chapterManga = $chapterManga;
        $this->middleware('auth:sanctum')->only('store', 'update', 'destroy');
    }

    public function index($id)
    {
        return $this->chapterManga->getAllChapeterbyMangaId($id);
    }

    public function store(CreateMangaChapterRequest $request)
    {
        return $this->chapterManga->createChapterManga($request);
    }

    public function show($id)
    {
        return $this->chapterManga->getChapterPages($id);
    }

    public function destroy($id)
    {
        return $this->chapterManga->deleteChapter($id);
    }
}
