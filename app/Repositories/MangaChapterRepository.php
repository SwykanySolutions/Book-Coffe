<?php

namespace App\Repositories;

use App\Repositories\Contracts\MangaChapterRepositoryInterface;
use App\Models\ChapterManga;
use App\Models\MangaPage;

class MangaChapterRepository implements MangaChapterRepositoryInterface
{

    protected $chapterManga;
    protected $mangaPage;

    public function __construct(ChapterManga $chapterManga, MangaPage $mangaPage)
    {
        $this->chapterManga = $chapterManga;
        $this->mangaPage = $mangaPage;
    }

    public function getAllChapeterbyMangaId(int $id)
    {
        $chapterManga = $this->chapterManga->where('manga_over_view_id', '=', $id)->first();
        return $chapterManga->paginate(10);
    }

    public function createChapter(array $request, int $userId, int $mangaOverViewId)
    {
        $chapterManga = $this->chapterManga->create($request);
        $chapterManga->user_id = $userId;
        $chapterManga->manga_over_view_id = $mangaOverViewId;
        $chapterManga->save();
        return $chapterManga;
    }

    public function CreatePages(array $uploadedPages)
    {
        $this->mangaPage::insert($uploadedPages);
    }

    public function getChapterPages(int $id)
    {
        $chapterManga = $this->chapterManga->with('manga_pages')->find($id);
        return $chapterManga;
    }

    public function deleteChapter(ChapterManga $chapterManga)
    {
        $chapterManga->delete();
    }

}
