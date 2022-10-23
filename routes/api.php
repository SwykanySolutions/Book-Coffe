<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FormatController;
use App\Http\Controllers\MangaChapterController;
use App\Http\Controllers\MangaOverViewController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::controller(UserController::class)->prefix('/user')->group(function () {
    Route::get('/', 'index');
    Route::get('/{name}/{tag}', 'show');
    Route::get('/me', 'me');
    Route::post('/', 'store');
    Route::post('/token', 'storeToken');
    Route::post('/update', 'update');
    Route::delete('/', 'destroy');
});

Route::controller(AuthController::class)->prefix('/auth/token')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'storeToken');
    Route::delete('/', 'destroy_all');
    Route::delete('/current', 'destroyCurrent');
    Route::delete('/{id}', 'destroy');
});

Route::controller(RoleController::class)->prefix('/admin')->name('admin.')->group(function () {
    Route::post('/role', 'store')->name('role.store');
    Route::get('/role', 'index')->name('role.index');
    Route::get('/role/{id}', 'show')->name('role.show');
    Route::put('/role/{id}', 'update')->name('role.update');
    Route::delete('/role/{id}', 'destroy')->name('role.destroy');
    Route::put('/role/permissions/{id}', 'updatePermissions')->name('role.permissions.update');
});

Route::controller(\App\Http\Controllers\Admin\UserController::class)->prefix('/admin')->name('admin.')->group(function () {
    Route::post('/role/user/{id}', 'updateRoles')->name('role.user.update');
});

Route::controller(\App\Http\Controllers\Admin\AuditController::class)->prefix('/admin')->name('admin.')->group(function () {
    //Route::get('/audit', 'index')->name('audit.index');
});

Route::controller(PeopleController::class)->prefix('/people')->name('people.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
    Route::delete('/{id}', 'destroy')->name('destroy');
    Route::post('/{id}', 'update')->name('update');
});

Route::apiResource('category', CategoryController::class);

Route::apiResource('status', StatusController::class);

Route::apiResource('format', FormatController::class);

Route::controller(MangaOverViewController::class)->prefix('/manga')->name('manga.over.view.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/ids', 'indexIds')->name('index.ids');
    Route::post('/', 'store')->name('store');
    Route::post('/{id}', 'update')->name('update');
    Route::get('/{id}', 'show')->name('show');
    Route::delete('/{id}', 'destroy')->name('destroy');
    Route::get('/view/{id}', 'newView');
});

Route::controller(ScoreController::class)->prefix('/manga')->name('manga.')->group(function () {
    Route::post('/score', 'store')->name('score.store');
});

Route::controller(MangaChapterController::class)->prefix('/chapter')->name('manga.chapter.')->group(function () {
    Route::get('/manga/{id}', 'index')->name('index');
    Route::get('/lasts', 'indexLasts')->name('index.lasts');
    Route::get('/manga/all/{id}', 'indexAll')->name('index.all');
    Route::get('/ids', 'indexIds')->name('index.ids');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/', 'store')->name('store');
    Route::delete('/{id}', 'destroy')->name('destroy');
});

Route::controller(SearchController::class)->prefix('/search')->group(function () {
    Route::get('/{name}', 'showMangaAndUser');
    Route::get('/manga/{name}', 'showManga');
    Route::get('/status/{name}', 'showStatus');
    Route::get('/format/{name}', 'showFormat');
    Route::get('/category/{name}', 'showCategory');
    Route::get('/people/{name}', 'showPeople');
});

Route::controller(SliderController::class)->prefix('/slider')->name('slider.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/', 'store')->name('store');
    Route::post('/{id}', 'update')->name('update');
    Route::delete('/{id}', 'destroy')->name('destroy');
});
