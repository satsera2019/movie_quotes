<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        dd("movie index");
        return view("user_panel.movie.index");
    }


    public function topMovieDirectors()
    {
        dd("topMovieDirectors");
    }
}
