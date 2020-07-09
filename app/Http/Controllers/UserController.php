<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use Auth;

class UserController extends Controller
{
    /**
     * Show user dashboard
     * 
     * @param Request $request
     * @return View
     * 
    */ 
    public function showDashboardPage(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = Link::where('user_id', $user_id)->orderBy('id', 'desc')->paginate(25);

        return view('users.dashboard', ['data' => $data]);
    }

    /**
     * Show link stats
     * 
     * @param Request $request
     * @param int $id
     * @return View
     * 
    */ 
    public function showLinkStatsPage(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $link = Link::where('id', $id)->where('user_id', $user_id)->first();
        if(!$link)
            abort(404);

        return view('users.stats', ['link' => $link]);
    }

}
