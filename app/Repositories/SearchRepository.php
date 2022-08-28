<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Format;
use App\Models\MangaOverView;
use App\Models\People;
use App\Models\Status;
use App\Models\User;
use App\Repositories\Contracts\SearchRepositoryInterface;

class SearchRepository implements SearchRepositoryInterface
{
    protected $mangaOverView;
    protected $user;
    protected $category;
    protected $format;
    protected $people;
    protected $status;

    public function __construct(MangaOverView $mangaOverView, User $user, Category $category, Format $format, People $people, Status $status)
    {
        $this->mangaOverView = $mangaOverView;
        $this->user = $user;
        $this->category = $category;
        $this->format = $format;
        $this->people = $people;
        $this->status = $status;
    }

    public function searchManga(string $query)
    {
        return $this->mangaOverView->search($query)->get();
    }

    public function searchUser(string $query)
    {
        return $this->user->query()
            ->where('name', 'like', "%{$query}%")
            ->get();
    }

    public function searchCategory(string $query)
    {
        return $this->category->query()
            ->where('name', 'like', "%{$query}%")
            ->get();
    }

    public function searchFormat(string $query)
    {
        return $this->format->query()
            ->where('name', 'like', "%{$query}%")
            ->get();
    }

    public function searchPeople(string $query)
    {
        return $this->people->query()
            ->where('name', 'like', "%{$query}%")
            ->get();
    }

    public function searchStatus(string $query)
    {
        return $this->status->query()
            ->where('name', 'like', "%{$query}%")
            ->get();
    }

}
