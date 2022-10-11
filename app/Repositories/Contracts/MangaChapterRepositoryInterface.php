<?php

namespace App\Repositories\Contracts;

use App\Models\ChapterManga;

interface MangaChapterRepositoryInterface
{
    public function getAllChapeterbyMangaId(int $id);
    public function getAllChapeterbyMangaIdNoPaginate(int $id);
    public function getAllChapeterIds();
    public function createChapter(array $request, int $userId, int $mangaOverViewId);
    public function CreatePages(array $uploadedPages);
    public function getChapterPages(int $id);
    public function getLastsChapters();
    public function deleteChapter(ChapterManga $chapterManga);
}
