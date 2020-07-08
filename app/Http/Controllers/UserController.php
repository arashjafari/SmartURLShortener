<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use Auth;

class UserController extends Controller
{
    public function showDashboardPage(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = Link::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(25);
        
        return view('users.dashboard', ['data' => $data]);
    }

}
