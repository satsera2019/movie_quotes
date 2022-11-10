<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LangController extends Controller
{
    public function switchLang($lang)
    {
        if (array_key_exists($lang, config()->get('lang'))) {
            $url   = url()->previous();
            $url_explode = explode("/",$url);
            $url_explode[3] = $lang;
            $redir = implode('/',$url_explode);
            app()->setLocale($lang);
            Session::put('locale', $lang);
            return redirect($redir);
        }
        return back();
    }
}
