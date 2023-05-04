<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manga\CreateMangaOverViewRequest;
use App\Http\Requests\UpdateMangaOverViewRequest;
use App\Services\MangaOverViewService;
use Illuminate\Http\Request;

class MangaOverViewController extends Controller
{

    private $mangaOverViewService;

    public function __construct(MangaOverViewService $mangaOverViewService)
    {
        $this->mangaOverViewService = $mangaOverViewService;
        $this->middleware(['auth:sanctum', 'access.control'])->only('store', 'update', 'destroy');
    }

    public function index(Request $request)
    {
        $order = $request->query('order');
        $order = $order == null ? 'DESC' : $order;
        $per_page = $request->query('per_page');
        $per_page = $per_page == null ? 20 : ($per_page > 60 ? 20 : $per_page);
        return $this->mangaOverViewService->getAllManga($order, $per_page);
    }

    public function indexIds()
    {
        return $this->mangaOverViewService->getAllMangaIds();
    }

    public function store(CreateMangaOverViewRequest $request)
    {
        return $this->mangaOverViewService->createManga($request);
    }

    public function update(UpdateMangaOverViewRequest $request, int $id)
    {
        return $this->mangaOverViewService->updateManga($request, $id);
    }

    public function newView(int $id)
    {
        $this->mangaOverViewService->setMangaViews($id);
    }

    public function show($id)
    {
        return $this->mangaOverViewService->getMangabyId($id);
    }

    public  function destroy(int $id)
    {
        $this->mangaOverViewService->deleteManga($id);
    }
}