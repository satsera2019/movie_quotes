<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(): View
    {
        return view("admin_panel.auth.index");
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with(['success' => false, 'error' => $validator->errors()->first()])->withInput();
        }
        $result = Auth::attempt([ 'email' => $request->email, 'password' => $request->password, 'role' => 'admin',]);
        if($result){
            return redirect()->route('admin-panel.movie-directors.index', ["locale" => app()->getLocale()]);
        }
        return back()->with(['success' => false, 'error' => "Password or email is incorrect"]);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin-panel.auth', ["locale" => app()->getLocale()]);
    }
}
