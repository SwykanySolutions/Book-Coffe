<?php

namespace App\Repositories;

use App\Models\ChapterManga;
use App\Models\MangaPage;
use App\Repositories\Contracts\MangaChapterRepositoryInterface;
use Illuminate\Support\Facades\DB;

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
        $chapterManga = $this->chapterManga->where('manga_over_view_id', '=', $id)->orderBy('chapter', 'DESC');
        return $chapterManga->paginate(10);
    }

    public function getAllChapeterbyMangaIdNoPaginate(int $id)
    {
        return $this->chapterManga->where('manga_over_view_id', '=', $id)->orderByRaw('CAST(chapter AS DOUBLE PRECISION) DESC')->get();
    }

    public function getAllChapeterIds()
    {
        return DB::select('select id from chapter_mangas');
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

    public function getLastsChapters()
    {
        return $this->chapterManga->with('manga_over_views')->orderBy('created_at', 'DESC')->paginate(20);
    }
}