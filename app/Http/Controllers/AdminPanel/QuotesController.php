<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
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
}
