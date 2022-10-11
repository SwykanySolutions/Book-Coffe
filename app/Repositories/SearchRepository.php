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

    public function searchManga(string $name)
    {
        return $this->mangaOverView->search($name)->get();
    }

    public function searchUser(string $name)
    {
        return $this->user->search($name)->get();
    }

    public function searchCategory(string $name)
    {
        return $this->category->query()
            ->where('name', 'like', "%{$name}%")
            ->get();
    }

    public function searchFormat(string $name)
    {
        return $this->format->query()
            ->where('name', 'like', "%{$name}%")
            ->get();
    }

    public function searchPeople(string $name)
    {
        return $this->people->query()
            ->where('name', 'like', "%{$name}%")
            ->get();
    }

    public function searchStatus(string $name)
    {
        return $this->status->query()
            ->where('name', 'like', "%{$name}%")
            ->get();
    }

}
