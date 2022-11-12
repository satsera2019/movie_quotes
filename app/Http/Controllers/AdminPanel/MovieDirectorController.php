<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\MovieDirector;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class MovieDirectorController extends Controller
{
    public function index(): View
    {
        $movie_directors = MovieDirector::all();
        $langs = config()->get('lang');
        return view("admin_panel.movie_directors.index", compact("movie_directors", "langs"));
    }
    
    public function createMovieDirector(): View
    {
        $langs = config()->get('lang');
        return view("admin_panel.movie_directors.create", compact("langs"));
    }

    public function editMovieDirector($lang, MovieDirector $director)
    {
        $langs = config()->get('lang');
        return view("admin_panel.movie_directors.edit", compact("langs", "director"));
    }

    public function deleteMovieDirector($lang, MovieDirector $director)
    {
        if($director->delete()){
            return redirect(route("admin-panel.movie-directors.index", ["locale" => app()->getLocale()]))->with('message', 'Movie director delete successfully.');
        }
        return redirect(route("admin-panel.movie-directors.index", ["locale" => app()->getLocale()]))->with('message', 'Error movie director delete.');
    }
    
    public function updateMovieDirector($lang, MovieDirector $director, Request $request)
    {
        $validation  = MovieDirector::validateMovieDirector($request->all());
        if ($validation["error"]) {return back()->with('error', $validation["message"]);}  
        $movie_director_updated = MovieDirector::updateMovieDirector($director, $request->all());
        if ($movie_director_updated) {
            return redirect(route("admin-panel.movie-directors.index", ["locale" => app()->getLocale()]))->with('message', 'Movie director updated successfully.');
        }
        return back()->with('error', 'Something went wrong.');
    }
    
    public function storeMovieDirector(Request $request)
    {
        $validation  = MovieDirector::validateMovieDirector($request->all());
        if ($validation["error"]) {
            return back()->with('error', $validation["message"]);
        }  
        $movie_director_created = MovieDirector::createMovieDirector($request->all());
        if ($movie_director_created) {
            return redirect(route("admin-panel.movie-directors.index", ["locale" => app()->getLocale()]))
            ->with('message', 'Movie director created successfully.');
        }
        return back()->with('error', 'Something went wrong.');
    }
}
