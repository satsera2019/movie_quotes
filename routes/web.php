<?php

use App\Http\Controllers\UserPanel\HomeController;
use App\Http\Controllers\UserPanel\MovieController;
use Illuminate\Support\Facades\App;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/{locale}', [HomeController::class, "index"], function ($locale) {
    App::setLocale($locale);
});

Route::get('/movie/{movie}', [MovieController::class, "index"])->name('movie.index'); // movie details

Route::get('/top-movie-directors', [MovieController::class, "topMovieDirectors"])->name('top.movie.directors'); // top movie directors


Route::middleware('check-admin')->group(function () {
    Route::namespace('AdminPanel')->name('admin-panel.')->prefix('admin-panel')->group(function () {
        
    });
});
