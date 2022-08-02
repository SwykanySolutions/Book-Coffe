<?php

namespace App\Repositories;

use App\Models\Score;
use App\Repositories\Contracts\ScoreRepositoryInterface;

class ScoreRepository implements ScoreRepositoryInterface
{

    protected $score;

    public function __construct(Score $score)
    {
        $this->score = $score;
    }

    public function getScoreById(int $Mangaid, int $Userid)
    {
        return $this->score
            ->where('user_id', '=', $Userid)
            ->where('manga_over_view_id', '=', $Mangaid)->first();
    }

    public function getScoresByMangaId(int $Mangaid)
    {
        return $this->score
            ->where('manga_over_view_id', '=', $Mangaid)->get();
    }

    public function markScore(int $Mangaid, int $Userid, float $score)
    {
        $score2 = new Score;
        $score2->score = $score;
        $score2->manga_over_view_id = $Mangaid;
        $score2->user_id = $Userid;
        $score2->save();
        return $score2;
    }

    public function update(int $id, float $score)
    {
        $score2 = $this->score->find($id);
        $score2->score = $score;
        $score2->save();
        return $score2;
    }

    public function deleteScore(int $id)
    {
        return $this->score->delete($id);
    }
}
