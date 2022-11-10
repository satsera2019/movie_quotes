<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\MovieDirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $movie_directors = MovieDirector::getActiveMovieDirector();
        return view("admin_panel.movies.create", compact("langs", "movie_directors"));
    }

    // public function editMovie(Request $request)
    public function editMovie(Movie $request)
    {
        dd($request->all(), $request);
        
        $langs = config()->get('lang');
        return view("admin_panel.movies.edit", compact("langs", "request"));
    }

    // public function editMovie(Request $request)
    public function deleteMovie(Movie $movie_id)
    {
        dd($movie_id);
    }


    public function storeMovie(Request $request)
    {
        $validation  = Movie::validateMovies($request->all());
        if ($validation["error"]) {
            return back()->with('error', $validation["message"]);
        }  
        $movie_created = Movie::createMovie($request->all());
        if ($movie_created) {
            return redirect(route("admin-panel.movies.index", ["locale" => app()->getLocale()]))
            ->with('message', 'Movie created successfully.');
        }
        return back()->with('error', 'Something went wrong.');
    }
}
