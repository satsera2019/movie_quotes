<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index(): View
    {
        $movies = Movie::all();
        return view("admin_panel.movies.index", compact("movies"));
    }
}
