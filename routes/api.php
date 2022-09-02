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
    Route::post('/update', 'update');
    Route::delete('/', 'destroy');
});

Route::controller(AuthController::class)->prefix('/auth/token')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'storeToken');
    Route::delete('/', 'destroy_all');
    Route::delete('/{id}', 'destroy');
});

Route::controller(\App\Http\Controllers\Admin\UserController::class)->middleware('auth:sanctum')->prefix('/admin')->group(function () {
    Route::post('/user/{id}', 'update_permission');
    Route::post('/managerpermisions/{id}', 'manager_permisions');
});

Route::controller(PeopleController::class)->prefix('/people')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
    Route::post('/update/{id}', 'update');
});

Route::apiResource('category', CategoryController::class);

Route::apiResource('status', StatusController::class);

Route::apiResource('format', FormatController::class);

Route::controller(MangaOverViewController::class)->prefix('/manga')->group(function () {
    Route::get('/', 'index');
    Route::get('/ids', 'indexIds');
    Route::post('/', 'store');
    Route::get('/{id}', 'show');
});

Route::controller(ScoreController::class)->prefix('/manga')->group(function () {
    Route::post('/score', 'store');
});

Route::controller(MangaChapterController::class)->prefix('/chapter')->group(function () {
    Route::get('/manga/{id}', 'index');
    Route::get('/manga/all/{id}', 'indexAll');
    Route::get('/ids', 'indexIds');
    Route::get('/{id}', 'show');
    Route::post('/', 'store');
    Route::delete('/{id}', 'destroy');
});

Route::controller(SearchController::class)->prefix('/search')->group(function () {
    Route::get('/{query}', 'showMangaAndUser');
    Route::get('/manga/{query}', 'showManga');
    Route::get('/status/{query}', 'showStatus');
    Route::get('/format/{query}', 'showFormat');
    Route::get('/category/{query}', 'showCategory');
    Route::get('/people/{query}', 'showPeople');
});

Route::controller(SliderController::class)->prefix('/slider')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});
