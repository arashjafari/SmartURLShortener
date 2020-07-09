<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Jenssegers\Agent\Agent;
use App\Link;
use App\LinkStats;
use Carbon\Carbon;

class LinkController extends Controller
{

    /**
     * Make a new short link.
     *
     * @param  Request  $request
     * @return View
    */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|max:2083',
            'customUrl' => 'nullable|unique:App\Link,custom|regex:/^[A-Za-z\d\-]{3,}$/i',
            'totalUses' => 'nullable|numeric|between:0,100000',
            'expiredDate' => 'nullable|regex:/^\d{4}\/\d{2}\/\d{2} \d{2}:\d{2}$/i',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
   
        $url = $request->input('url');
        $customUrl = $request->input('customUrl');
        $totalUses = $request->input('totalUses');
        $expiredDate = $request->input('expiredDate');

        $totalUses = $totalUses == 0 ? null : $totalUses;
        $customUrl = $this->makeUniqueCustomUrl($customUrl); 
        $userId = getCurrentUserId();
 
        $link = new Link;
        $link->user_id = $userId;
        $link->ip = $request->ip(); 
        $link->url = $url;
        $link->custom = $customUrl; 
        $link->total_uses = $totalUses; 
        $link->used = 0;
        $link->expire_at = $expiredDate;
        $link->active = true;
        $link->save();

        $shortLink = $this->getShortLink($link->custom);

        return redirect()->route('homepage')->with('shortLink', $shortLink);
    }

    /**
     * Make a random custom url
     *
     * @param  int  $length
     * @return string
    */
    private function generateRandomCustomUrl($length = 0)
    {
        if($length == 0)
            $length = rand(4,7);

        $permittedChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-'; 
        return substr(str_shuffle($permittedChars), 0, $length);
    }

   /**
    * Suggestion a unique custom url
    *
    * @param  string  $userCustomUrl
    * @return string
   */
    private function makeUniqueCustomUrl($userCustomUrl = "")
    {
        if(Str::of($userCustomUrl)->isNotEmpty())
            return $userCustomUrl;

        $rndCustom = ""; 
        do
        {
            $rndCustom = $this->generateRandomCustomUrl();
        }while(Link::whereCustom($rndCustom)->whereActive(true)->count() != 0);

        return $rndCustom;
    }

    
    /**
     * Get final short link
     * 
     * @param string $custom
     * @return string
    */
    private function getShortLink($custom)
    {
       $app_url = config('app.url'); 
       $link =  Str::finish($app_url, '/') . $custom;

       return $link;
    }

    /**
     * Redirect to main link by short link
     * 
     * @param Request $request
     * @param string $short
     * @return \Illuminate\Http\RedirectResponse
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function short2Long(Request $request, $short)
    {
        $link = Link::whereCustom($short)->whereActive(true)->first();
        if(!$link)
            abort(404);

        
        if($link->expire_at != null)
        {
            $now = Carbon::now(); 
            $expireAt = Carbon::parse($link->expire_at);
            
            if($now->greaterThan($expireAt))
            {
                $link->active = false;
                $link->save();
                abort(404);
            } 
        }
        
        if($link->total_uses != null)
        {  
            if($link->used >= $link->total_uses)
            {
                $link->active = false;
                $link->save();
                abort(404);
            } 
            
            $link->used += 1;
            $link->save();
        }  

        $this->addLinkStats($link->id, $request->ip()); 
        
        return Redirect::to($link->url, 301);
    }

    /**
     * Add link stats
     * 
     * @param int $linkId
     * @param string $ip
     * @return void
     * 
     */
    private function addLinkStats($linkId, $ip)
    {
        $agent = new Agent; 
        $inkStats = new LinkStats;
        $inkStats->user_id = getCurrentUserId();
        $inkStats->ip = $ip; 
        $inkStats->link_id = $linkId; 
        $inkStats->is_robot = $agent->isRobot();
        $inkStats->is_phone = $agent->isPhone(); 
        $inkStats->is_desktop = $agent->isDesktop();
        $inkStats->device_nmae = $agent->device();
        $inkStats->platform_name = $agent->platform();
        $inkStats->browser_name = $agent->browser();
        $inkStats->save();
    }

}
