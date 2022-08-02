<?php

namespace App\Services;

use App\Repositories\Contracts\ScoreRepositoryInterface;
use Illuminate\Http\Request;

class ScoreService
{
    private $scoreRepository;

    public function __construct(ScoreRepositoryInterface $score)
    {
        $this->scoreRepository = $score;
    }

    public function createScore(Request $request)
    {
        $user = auth()->user();
        $score = $this->scoreRepository->getScoreById($request->input('manga_id'), $user->id);

        if ($score) {
            return $this->scoreRepository->update($score->id, $request->input('score'));
        }
        return $this->scoreRepository->markScore($request->input('manga_id'), $user->id, $request->input('score'));
    }
}
