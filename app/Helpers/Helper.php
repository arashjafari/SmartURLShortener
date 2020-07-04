<?php
 
if (!function_exists('getCurrentUserId')) {
    function getCurrentUserId()
    {  
        if(\Auth::user())
        {
            return \Auth::user()->id;
        }
        else
        {
            return null;
        }
    }
}
