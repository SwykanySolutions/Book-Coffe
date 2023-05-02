<?php

namespace App\Repositories;

use App\Models\Format;
use App\Models\MangaOverView;
use App\Models\Status;
use App\Repositories\Contracts\MangaOverViewRepositoryInterface;
use Illuminate\Support\Facades\DB;

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

    public function getAllManga(string $order)
    {
        return $this->manga->orderBy('created_at', $order)->paginate(20);
    }

    public function getAllMangaIds()
    {
        return DB::select('select id from manga_over_views');
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
        return $manga;
    }

    public function deleteMangabyId(int $id)
    {
        $manga = $this->manga->find($id);
        $manga->delete();
    }

    public function updateManga(array $request, int $status, int $format, array $categories, array $staffs, int $id)
    {
        $manga = $this->manga->find($id);
        $manga->update($request);
        $manga->categories()->attach(array_map('intval', $categories));
        $manga->people()->attach(array_map('intval', $staffs));
        $manga->status_id = $status;
        $manga->format_id = $format;
        $manga->save();
        return $manga;
    }
}