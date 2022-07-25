<?php

namespace App\Services;

use App\Repositories\Contracts\FormatRepositoryInterface;
use App\Repositories\Contracts\MangaOverViewRepositoryInterface;
use App\Repositories\Contracts\StatusRepositoryInterface;
use Illuminate\Http\Request;

class MangaOverViewService
{

    protected $manga;
    protected $format;
    protected $status;

    public function __construct(MangaOverViewRepositoryInterface $manga, FormatRepositoryInterface $format, StatusRepositoryInterface $status)
    {
        $this->manga = $manga;
        $this->format = $format;
        $this->status = $status;
    }

    public function getMangabyId(int $id)
    {
        $manga = $this->manga->getMangabyId($id);
        if ($manga) {
            $manga->views = $manga->views + 1;
            $manga->save();
            $manga->format = $this->format->getFormatbyId($manga->format_id);
            $manga->status = $this->status->getStatusbyId($manga->status_id);
            unset($manga->format_id);
            unset($manga->status_id);
            return $manga;
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

}
