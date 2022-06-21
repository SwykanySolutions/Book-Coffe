<?php

namespace App\Repositories;

use App\Repositories\Contracts\SearchRepositoryInterface;
use App\Models\MangaOverView;
use App\Models\User;

class SearchRepository implements SearchRepositoryInterface
{
    protected $mangaOverView;
    protected $user;

    public function __construct(MangaOverView $mangaOverView, User $user)
    {
        $this->mangaOverView = $mangaOverView;
        $this->user = $user;
    }

    public function searchManga(string $query)
    {
        return $this->mangaOverView->query()
        ->where('name', 'like', "%{$query}%")
        ->orWhere('synopsis', 'like', "%{$query}%")
        ->get();
    }

    public function searchUser(string $query)
    {
        return $this->user->query()
        ->where('name', 'like', "%{$query}%")
        ->get();
    }
}
