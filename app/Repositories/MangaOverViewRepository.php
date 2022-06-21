<?php

namespace App\Repositories;

use App\Repositories\Contracts\MangaOverViewRepositoryInterface;
use App\Models\MangaOverView;
use App\Models\Format;
use App\Models\Status;

class MangaOverViewRepository implements MangaOverViewRepositoryInterface
{

    protected $manga;
    protected $format;
    protected $status;

    public function __construct(MangaOverView $manga, Format $format, Status $status)
    {
        $this->manga = $manga;
        $this->format = $format;
        $this->status = $status;
    }

    public function getAllManga()
    {
        return $this->manga->paginate(10);
    }

    public function createManga(array $request, int $status, int $format, array $categories, array $staffs)
    {
        $manga = $this->manga->create($request);
        $manga->categories()->attach(array_map('intval', $categories));
        $manga->people()->attach(array_map('intval', $staffs));
        $manga->status_id = $status;
        $manga->format_id = $format;
        $manga->save();
        return $manga;
    }

    public function getMangabyId(int $id)
    {
        $manga = $this->manga->with('categories', 'people')->find($id);
        $manga->format = $this->format->find($manga->format_id);
        $manga->status = $this->status->find($manga->status_id);
        return $manga;
    }

}
