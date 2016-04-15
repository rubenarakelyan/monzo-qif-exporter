<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // Home
    public function home(Request $request)
    {
	    return view('app.home');
    }
    
    // About
    public function about(Request $request)
    {
	    return view('app.about');
    }
}
