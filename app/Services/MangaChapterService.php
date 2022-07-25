<?php

namespace App\Services;

use App\Repositories\Contracts\MangaChapterRepositoryInterface;
use App\Repositories\Contracts\MangaOverViewRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MangaChapterService
{

    protected $mangaChapterRepository;
    protected $mangaOverViewRepository;

    public function __construct(MangaChapterRepositoryInterface $mangaChapterRepository, MangaOverViewRepositoryInterface $mangaOverViewRepository)
    {
        $this->mangaChapterRepository = $mangaChapterRepository;
        $this->mangaOverViewRepository = $mangaOverViewRepository;
    }

    public function getAllChapeterbyMangaId(int $id)
    {
        return $this->mangaChapterRepository->getAllChapeterbyMangaId($id);
    }

    public function getAllChapeterbyMangaIdNoPaginate(int $id)
    {
        return $this->mangaChapterRepository->getAllChapeterbyMangaIdNoPaginate($id);
    }

    public function getAllIds()
    {
        return $this->mangaChapterRepository->getAllChapeterIds();
    }

    public function getChapterPages(int $id)
    {
        return $this->mangaChapterRepository->getChapterPages($id);
    }

    public function createChapterManga(Request $request)
    {
        $infos = $request->all();
        $user = auth()->user();
        $mangaOverView = $this->mangaOverViewRepository->getMangabyId($request->manga_id);
        $chapter = $this->mangaChapterRepository->createChapter($infos, $user->id, $mangaOverView->id);
        $uploadedPages = [];
        foreach ($request->file('pages') as $pages) {
            $uploadedPages[] = ['page' => $pages->store('chapters/pages/' . $chapter->id, 'public'), 'chapter_manga_id' => $chapter->id, 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')];
        }
        $this->mangaChapterRepository->CreatePages($uploadedPages);
        return $this->mangaChapterRepository->getChapterPages($chapter->id);
    }

    public function deleteChapter(int $id)
    {
        $user = auth()->user();
        if ($user->delete_manga_chapter || $user->owner) {
            $chapterManga = $this->getChapterPages($id);
            if (!$chapterManga) {
                return abort(404);
            }

            foreach ($chapterManga->manga_pages as $pages) {
                if (Storage::disk('public')->exists($pages->page)) {
                    Storage::disk('public')->delete($pages->page);
                }
            }
            $this->mangaChapterRepository->deleteChapter($chapterManga);
        }
    }

}
