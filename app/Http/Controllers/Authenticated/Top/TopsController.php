<?php

namespace App\Http\Controllers\Authenticated\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopsController extends Controller
{
    public function show(){
        return view('authenticated.top.top');
    }

    public function showSidebar(){
        $user = Auth::user();
        return view('layouts.sidebar', ['user' => $user]);
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }

}
