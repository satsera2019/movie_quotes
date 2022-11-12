<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\MovieDirector;
use App\Models\Quote;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index(): View
    {
        $movies = Movie::all();
        $langs = config()->get('lang');
        return view("admin_panel.movies.index", compact("movies", "langs"));
    }

    public function createMovie(): View
    {
        $langs = config()->get('lang');
        $movie_directors = MovieDirector::all();
        return view("admin_panel.movies.create", compact("langs", "movie_directors"));
    }

    public function editMovie($lang, Movie $movie)
    {
        $langs = config()->get('lang');
        $movie_directors = MovieDirector::all();
        return view("admin_panel.movies.edit", compact("langs", "movie", 'movie_directors'));
    }

    public function deleteMovie($lang, Movie $movie)
    {
        if($movie->delete() && Quote::where("movie_id", $movie->id)->delete()){
            return redirect(route("admin-panel.movies.index", ["locale" => app()->getLocale()]))->with('message', 'Movie delete successfully.');
        }
        return redirect(route("admin-panel.movies.index", ["locale" => app()->getLocale()]))->with('message', 'Error movie delete.');
    }

    public function storeMovie(Request $request)
    {
        $validation  = Movie::validateMovies($request->all());
        if ($validation["error"]) {return back()->with('error', $validation["message"]);}  
        $movie_created = Movie::createMovie($request->all());
        if ($movie_created) {
            return redirect(route("admin-panel.movies.index", ["locale" => app()->getLocale()]))->with('message', 'Movie created successfully.');
        }
        return back()->with('error', 'Something went wrong.');
    }

    public function updateMovie($lang, Request $request, $movie)
    {
        $movie = Movie::find($movie);
        $validation  = Movie::validateMovies($request->all());
        if ($validation["error"]) {return back()->with('error', $validation["message"]);}
        $movie_updated = Movie::updateMovie($movie, $request->all());
        if ($movie_updated) {
            return redirect(route("admin-panel.movies.index", ["locale" => app()->getLocale()]))->with('message', 'Movie update successfully.');
        }
        return back()->with('error', 'Something went wrong.');
    }
}
