<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    SearchRepositoryInterface,
    StatusRepositoryInterface,
    UserRepositoryInterface,
    PeopleRepositoryInterface,
    MangaOverViewRepositoryInterface,
    MangaChapterRepositoryInterface,
    FormatRepositoryInterface,
    CategoryRepositoryInterface
};
use App\Repositories\{
    SearchRepository,
    StatusRepository,
    UserRepository,
    PeopleRepository,
    MangaOverViewRepository,
    MangaChapterRepository,
    FormatRepository,
    CategoryRepository
};
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
