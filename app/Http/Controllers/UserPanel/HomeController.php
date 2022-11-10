<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Spatie\TranslationLoader\LanguageLine;

class HomeController extends Controller
{
    public function index()
    {
        $random_quote = Quote::getRandomQuote(1)[0];
        // dd($random_quote);
        return view("user_panel.home.index", compact("random_quote"));
    }

    public function movie($locale, Movie $movie): View
    {
        dd($movie);
        // $movie = Quote::getRandomQuote(1)[0];
        // dd($random_quote);
        return view("user_panel.home.movie", compact("movie"));
    }
}
