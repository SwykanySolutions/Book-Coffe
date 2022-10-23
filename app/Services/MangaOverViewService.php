<?php

namespace App\Services;

use App\Repositories\Contracts\FormatRepositoryInterface;
use App\Repositories\Contracts\MangaChapterRepositoryInterface;
use App\Repositories\Contracts\MangaOverViewRepositoryInterface;
use App\Repositories\Contracts\ScoreRepositoryInterface;
use App\Repositories\Contracts\StatusRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MangaOverViewService
{

    protected $manga;
    protected $format;
    protected $status;
    protected $score;
    protected $chapter;

    public function __construct(
        MangaOverViewRepositoryInterface $manga,
        FormatRepositoryInterface $format,
        StatusRepositoryInterface $status,
        ScoreRepositoryInterface $score,
        MangaChapterRepositoryInterface $chapter
    ) {
        $this->manga = $manga;
        $this->format = $format;
        $this->status = $status;
        $this->score = $score;
        $this->chapter = $chapter;
    }

    public function getMangabyId(int $id)
    {
        $manga = $this->manga->getMangabyId($id);
        if ($manga) {
            $score = 0;
            $scores = $this->score->getScoresByMangaId($id);
            if (count($scores)) {
                for ($i = 0; $i < count($scores); $i++) {
                    $score += $scores[$i]->score;
                }
                $score = $score / count($scores);
            }
            $manga->score = $score;
            $format = $this->format->getFormatbyId($manga->format_id);
            $status = $this->status->getStatusbyId($manga->status_id);
            $manga->format = !$format ? ['name' => 'Desconhecido'] : $format;
            $manga->status = !$status ? ['name' => 'Desconhecido'] : $status;
            unset($manga->format_id);
            unset($manga->status_id);
            return $manga;
        } else {
            abort(404);
        }
    }

    public  function setMangaViews(int $id) {
        $manga = $this->manga->getMangabyId($id);
        if ($manga) {
            $manga->views = $manga->views + 1;
            $manga->save();
        } else {
            abort(404);
        }
    }

    public function getAllManga()
    {
        return $this->manga->getAllManga();
    }

    public function getAllMangaIds()
    {
        return $this->manga->getAllMangaIds();
    }

    public function createManga(Request $request)
    {
        $infos = $request->all();
        if ($photo = $request->file('photo')) {
            $infos['photo'] = $photo->store('manga_photo', 'public');
        }

        if ($photo = $request->file('background_photo')) {
            $infos['background_photo'] = $photo->store('manga_background_photo', 'public');
        }

        unset($infos["status"]);
        unset($infos["format"]);
        $manga = $this->manga->createManga($infos, $request->status, $request->format, $request->categories, $request->staffs);
        return $this->manga->getMangabyId($manga->id);
    }

    public function updateManga(Request $request, int $id)
    {
        $infos = $request->all();
        $manga = $this->manga->getMangabyId($id);
        if ($photo = $request->file('photo')) {
            $photoPath = str_replace("storage/", "", $manga->photo);
            if (Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            $infos['photo'] = $photo->store('manga_photo', 'public');
        }

        if ($photo = $request->file('background_photo')) {
            $photoPath = str_replace("storage/", "", $manga->background_photo);
            if (Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }
            $infos['photo'] = $photo->store('background_photo', 'public');
        }

        unset($infos["status"]);
        unset($infos["format"]);
        $manga = $this->manga->updateManga($infos, $request->status, $request->format, $request->categories, $request->staffs);
        return $this->manga->getMangabyId($manga->id);
    }

    public function deleteManga(int $id)
    {
        $chapters = $this->chapter->getAllChapeterbyMangaId($id);
        $manga = $this->manga->getMangabyId($id);
        foreach ($chapters as $chapter)
        {
            $chapterManga = $this->chapter->getChapterPages($chapter->id);

            foreach ($chapterManga->manga_pages as $pages) {
                $pagePath = str_replace("storage/", "", $pages->page);
                if (Storage::disk('public')->exists($pagePath)) {
                    Storage::disk('public')->delete($pagePath);
                }
            }
            $this->chapter->deleteChapter($chapter);
        }
        $photoPath = str_replace("storage/", "", $manga->photo);
        if (Storage::disk('public')->exists($photoPath)) {
            Storage::disk('public')->delete($photoPath);
        }
        $backgroundPath = str_replace("storage/", "", $manga->background_photo);
        if (Storage::disk('public')->exists($backgroundPath)) {
            Storage::disk('public')->delete($backgroundPath);
        }
        $this->manga->deleteMangabyId($id);
    }

}
