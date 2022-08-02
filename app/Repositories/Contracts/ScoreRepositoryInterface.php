<?php

namespace App\Repositories\Contracts;

interface ScoreRepositoryInterface
{
    public function getScoreById(int $Mangaid, int $Userid);
    public function getScoresByMangaId(int $Mangaid);
    public function markScore(int $Mangaid, int $Userid, float $score);
    public function update(int $id, float $score);
    public function deleteScore(int $id);
}
