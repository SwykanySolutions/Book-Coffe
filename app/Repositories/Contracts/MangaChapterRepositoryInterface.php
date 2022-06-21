<?php

namespace App\Repositories\Contracts;

use App\Models\ChapterManga;

interface MangaChapterRepositoryInterface
{
    public function getAllChapeterbyMangaId(int $id);
    public function createChapter(array $request, int $userId, int $mangaOverViewId);
    public function getChapterPages(int $id);
    public function deleteChapter(ChapterManga $chapterManga);
}
