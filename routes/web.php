<?php

use App\Http\Controllers\AdminPanel\AuthController;
use App\Http\Controllers\AdminPanel\MovieDirectorController;
use App\Http\Controllers\AdminPanel\MoviesController;
use App\Http\Controllers\AdminPanel\QuotesController;
use App\Http\Controllers\LangController;
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
//     return redirect(route('user-panel.index'));
// });


Route::get('{locale}/user-panel', [HomeController::class, "index"], function ($locale) {
    App::setLocale($locale);
    
})->name("user-panel.index");

Route::get('{locale}/user-panel/movie/{movie}', [HomeController::class, "movie"], function ($locale) {
    App::setLocale($locale);
})->name("home.movie");

// Route::get('{locale}/user-panel/{movie}',[
//     // C:\Saba\xampp\htdocs\movie_quotes\app\Http\Controllers\UserPanel\HomeController.php
//     'uses'=>'\app\Http\Controllers\UserPanel\HomeController@movie',
//     'as'=>'home.movie'
// ]);

    // Route::get('events/{event}/remind/{user}', [
    //     'as' => 'remindHelper', 'uses' => 'EventsController@remindHelper']);


Route::get('/movie/{movie}', [MovieController::class, "index"])->name('movie.index'); // movie details
Route::get('/top-movie-directors', [MovieController::class, "topMovieDirectors"])->name('top.movie.directors'); // top movie directors

// Route::get('locale/{lang}', ['as' => 'lang.switch', 'uses' => '\App\Http\Controllers\LangController@switchLang']);
Route::get('locale/{locale}', [LangController::class, "switchLang"])->name("change-lang");

Route::get('/', [AuthController::class, "index"])->prefix('/{locale}/admin-panel')->name("admin-panel.auth"); 

Route::namespace('AdminPanel')->name('admin-panel.')->prefix('/{locale}/admin-panel')->group(function () {

    Route::post('/login', [AuthController::class, "login"])->name("login");
    Route::get('/', [AuthController::class, "index"])->name("auth"); 
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::middleware('check-admin')->group(function () {
        Route::middleware(['auth'])->group(function () {

            Route::get('/', [MoviesController::class, "index"])->name("movies.index"); 
            
            Route::name('movies.')->prefix('movies')->group(function () {
                Route::get('/', [MoviesController::class, "index"])->name("index"); 
                Route::get('/create-movie', [MoviesController::class, "createMovie"])->name("create");
                Route::post('/store-movie', [MoviesController::class, "storeMovie"])->name("store");
                Route::get('/edit/{movie}', [MoviesController::class, "editMovie"])->name("edit");
                Route::post('/delete/{movie}', [MoviesController::class, "deleteMovie"])->name("delete");
            });  

            Route::name('quotes.')->prefix('quotes')->group(function () {
                Route::get('/', [QuotesController::class, "index"])->name("index");
                Route::get('/create-quote', [QuotesController::class, "createQuote"])->name("create");
                Route::post('/store-quote', [QuotesController::class, "storeQuote"])->name("store");
            });

            Route::name('movie-directors.')->prefix('movie-directors')->group(function () {
                Route::get('/', [MovieDirectorController::class, "index"])->name("index");
                Route::get('/create-movie-director', [MovieDirectorController::class, "createMovieDirector"])->name("create");
                Route::post('/store-movie-director', [MovieDirectorController::class, "storeMovieDirector"])->name("store");
                Route::get('/edit/{director}', [MovieDirectorController::class, "editMovieDirector"])->name("edit");
                Route::post('/delete/{director}', [MovieDirectorController::class, "deleteMovieDirector"])->name("delete");
            });

        });
    });


});
