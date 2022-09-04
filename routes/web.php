<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::controller(AuthController::class)->prefix('/auth')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::delete('/', 'destroy_all');
    Route::delete('/{id}', 'destroy');
});

Route::get('/documentation', function () {
    return view('doc.index');
});
