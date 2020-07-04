<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the home page.
     * 
     * @return View
     */ 
    public function showHomePage()
    {
        return view('home');
    }
}
