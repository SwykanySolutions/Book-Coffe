<?php

namespace App\Repositories\Contracts;

interface MangaOverViewRepositoryInterface
{
    public function getAllManga();
    public function createManga(array $request, int $status, int $format, array $categories, array $staffs);
    public function getMangabyId(int $id);
}
