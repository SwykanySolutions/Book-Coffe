<?php

namespace App\Repositories\Contracts;

interface MangaOverViewRepositoryInterface
{
    public function getAllManga(string $order, int $per_page);
    public function getAllMangaIds();
    public function createManga(array $request, int $status, int $format, array $categories, array $staffs);
    public function updateManga(array $request, int $status, int $format, array $categories, array $staffs, int $id);
    public function getMangabyId(int $id);
    public function deleteMangabyId(int $id);
}