<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Quote;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    public function index(): View
    {
        $quotes = Quote::all();
        return view("admin_panel.quotes.index", compact("quotes"));
    }

    public function createQuote(): View
    {
        $langs = config()->get('lang');
        $movies = Movie::getActiveMovies();
        return view("admin_panel.quotes.create", compact("langs", "movies"));
    }

    public function storeQuote(Request $request)
    {
        $validation  = Quote::validateQuote($request->all());
        if ($validation["error"]) {
            return back()->with('error', $validation["message"]);
        }  
        $quote_created = Quote::createQuote($request->all());
        if ($quote_created) {
            return redirect(route("admin-panel.quotes.index", ["locale" => app()->getLocale()]))
            ->with('message', 'Quote created successfully.');
        }
        return back()->with('error', 'Something went wrong.');
    }
}
