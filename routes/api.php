<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\PeopleController;

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

//Route::apiResource('auth', \App\Http\Controllers\AuthController::class);

//Route::apiResource('user', \App\Http\Controllers\UserController::class);

Route::prefix('/user')->group(function(){
    Route::get('/', [UserController::class,'index']);
    Route::get('/{name}/{tag}', [UserController::class,'show']);
    Route::post('/', [UserController::class,'store']);
    Route::post('/update', [UserController::class,'update']);
    Route::delete('/', [UserController::class,'destroy']);
});

Route::prefix('/auth')->group(function(){
    Route::get('/', [AuthController::class,'index']);
    Route::post('/', [AuthController::class,'store']);
    Route::delete('/', [AuthController::class,'destroy_all']);
    Route::delete('/{id}', [AuthController::class,'destroy']);
});

Route::middleware('auth:sanctum')->prefix('/admin')->group(function(){
    Route::post('/user/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update_permission']);
    Route::post('/managerpermisions/{id}', [\App\Http\Controllers\Admin\UserController::class, 'manager_permisions']);
});

Route::prefix('/people')->group(function(){
    Route::post('/', [PeopleController::class, 'store']);
    Route::get('/{id}', [PeopleController::class, 'show']);
    Route::delete('/{id}', [PeopleController::class, 'destroy']);
    Route::post('/update/{id}', [PeopleController::class, 'update']);
});

Route::apiResource('category', \App\Http\Controllers\CategoryController::class)->except(['show','index']);
