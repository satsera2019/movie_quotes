<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Quote;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $quotes = Quote::all();
        $random_quote = [];
        if(count($quotes) > 0){$random_quote = $quotes->random(1); $random_quote = $random_quote[0];}
        return view("user_panel.home.index", compact("random_quote"));
    }

    public function movie($locale, Movie $movie): View
    {
        return view("user_panel.home.movie", compact("movie"));
    }

    public function topMovieDirectors(): View
    {
        $top_movie = Quote::getTopMovieDirectors(3);
        return view("user_panel.home.top_movie_directors", compact("top_movie"));
    }
}
