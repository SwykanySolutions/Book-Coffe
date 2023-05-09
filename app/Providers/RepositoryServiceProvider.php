<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\FormatRepositoryInterface;
use App\Repositories\Contracts\MangaChapterRepositoryInterface;
use App\Repositories\Contracts\MangaOverViewRepositoryInterface;
use App\Repositories\Contracts\PeopleRepositoryInterface;
use App\Repositories\Contracts\ScoreRepositoryInterface;
use App\Repositories\Contracts\SearchRepositoryInterface;
use App\Repositories\Contracts\StatusRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\SliderRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\ResourceRepositoryInterface;
use App\Repositories\Contracts\AuditRepositoryInterface;
use App\Repositories\Contracts\UserListRepositoryInterface;
use App\Repositories\FormatRepository;
use App\Repositories\MangaChapterRepository;
use App\Repositories\MangaOverViewRepository;
use App\Repositories\PeopleRepository;
use App\Repositories\ScoreRepository;
use App\Repositories\SearchRepository;
use App\Repositories\StatusRepository;
use App\Repositories\UserRepository;
use App\Repositories\SliderRepository;
use App\Repositories\RoleRepository;
use App\Repositories\ResourceRepository;
use App\Repositories\AuditRepository;
use App\Repositories\UserListRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            SearchRepositoryInterface::class,
            SearchRepository::class,
        );

        $this->app->bind(
            StatusRepositoryInterface::class,
            StatusRepository::class,
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class,
        );

        $this->app->bind(
            PeopleRepositoryInterface::class,
            PeopleRepository::class,
        );

        $this->app->bind(
            MangaOverViewRepositoryInterface::class,
            MangaOverViewRepository::class,
        );

        $this->app->bind(
            MangaChapterRepositoryInterface::class,
            MangaChapterRepository::class,
        );

        $this->app->bind(
            FormatRepositoryInterface::class,
            FormatRepository::class,
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class,
        );

        $this->app->bind(
            ScoreRepositoryInterface::class,
            ScoreRepository::class,
        );

        $this->app->bind(
            SliderRepositoryInterface::class,
            SliderRepository::class
        );

        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );

        $this->app->bind(
            ResourceRepositoryInterface::class,
            ResourceRepository::class
        );

        $this->app->bind(
            AuditRepositoryInterface::class,
            AuditRepository::class
        );

        $this->app->bind(
            UserListRepositoryInterface::class,
            UserListRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}