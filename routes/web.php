<?php

use App\Http\Controllers\AdminPanel\AuthController;
use App\Http\Controllers\AdminPanel\MovieDirectorController;
use App\Http\Controllers\AdminPanel\MoviesController;
use App\Http\Controllers\AdminPanel\QuotesController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\UserPanel\HomeController;
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

Route::get('{locale}/user-panel', [HomeController::class, "index"])->name("user-panel.index");
Route::get('{locale}/user-panel/movie/{movie}', [HomeController::class, "movie"])->name("home.movie");
Route::get('{locale}/user-panel/top-movie-directors', [HomeController::class, "topMovieDirectors"])->name("top.movie.directors");

Route::get('locale/{locale}', [LangController::class, "switchLang"])->name("change-lang");


Route::get('/', [AuthController::class, "index"])->prefix('/{locale}/admin-panel')->name("admin-panel.auth"); 

Route::namespace('AdminPanel')->name('admin-panel.')->prefix('/{locale}/admin-panel')->group(function () {
    Route::post('/login', [AuthController::class, "login"])->name("login");
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::middleware('check-admin')->group(function () {
        Route::name('movies.')->prefix('movies')->group(function () {
            Route::get('/', [MoviesController::class, "index"])->name("index"); 
            Route::get('/create-movie', [MoviesController::class, "createMovie"])->name("create");
            Route::post('/store-movie', [MoviesController::class, "storeMovie"])->name("store");
            Route::get('/edit/{movie}', [MoviesController::class, "editMovie"])->name("edit");
            Route::post('/update/{movie}', [MoviesController::class, "updateMovie"])->name("update");
            Route::post('/delete/{movie}', [MoviesController::class, "deleteMovie"])->name("delete");
        });  

        Route::name('quotes.')->prefix('quotes')->group(function () {
            Route::get('/', [QuotesController::class, "index"])->name("index");
            Route::get('/create-quote', [QuotesController::class, "createQuote"])->name("create");
            Route::get('/edit/{quote}', [QuotesController::class, "editQuote"])->name("edit");
            Route::post('/update/{quote}', [QuotesController::class, "updateQuote"])->name("update");
            Route::post('/store-quote', [QuotesController::class, "storeQuote"])->name("store");
            Route::post('/delete/{quote}', [QuotesController::class, "deleteQuote"])->name("delete");
        });

        Route::name('movie-directors.')->prefix('movie-directors')->group(function () {
            Route::get('/', [MovieDirectorController::class, "index"])->name("index");
            Route::get('/create-movie-director', [MovieDirectorController::class, "createMovieDirector"])->name("create");
            Route::post('/store-movie-director', [MovieDirectorController::class, "storeMovieDirector"])->name("store");
            Route::get('/edit/{director}', [MovieDirectorController::class, "editMovieDirector"])->name("edit");
            Route::post('/update/{director}', [MovieDirectorController::class, "updateMovieDirector"])->name("update");
            Route::post('/delete/{director}', [MovieDirectorController::class, "deleteMovieDirector"])->name("delete");
        });
    });
});
