<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Spatie\TranslationLoader\LanguageLine;

class HomeController extends Controller
{
    public function index()
    {


//        LanguageLine::create([
//            'group' => 'quote',
//            'key' => '2',
//            'text' => ['en' => 'first quote', 'ka' => 'პირველი ციტატა'],
//        ]);

//        dd(LanguageLine::get());
        $random_movie = Movie::all();
        dd($random_movie);
        return view("user_panel.home.index");
    }
}
