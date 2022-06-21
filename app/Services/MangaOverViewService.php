<?php

namespace App\Services;

use App\Repositories\Contracts\MangaOverViewRepositoryInterface;
use Illuminate\Http\Request;

class MangaOverViewService
{

    protected $manga;

    public function __construct(MangaOverViewRepositoryInterface $manga)
    {
        $this->manga = $manga;
    }

    public function getMangabyId(int $id)
    {
        $manga = $this->manga->getMangabyId($id);
        unset($manga->format_id);
        unset($manga->status_id);
        return $manga;
    }

    public function getAllManga()
    {
        return $this->manga->getAllManga();
    }

    public function createManga(Request $request)
    {
        $infos = $request->all();
        if($photo = $request->file('photo')) $infos['photo'] = $photo->store('manga_photo', 'public');
        if($photo = $request->file('background_photo')) $infos['background_photo'] = $photo->store('manga_background_photo', 'public');
        unset($infos["status"]);
        unset($infos["format"]);
        $manga = $this->manga->createManga($infos, $request->status, $request->format, $request->categories, $request->staffs);
        return $this->manga->getMangabyId($manga->id);
    }

}
