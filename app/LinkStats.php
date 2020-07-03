<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkStats extends Model
{
    protected $fillable = ['link_id', 'user_id', 'ip', 'is_robot', 'is_phone', 'is_desktop', 'device_nmae', 'platform_name', 'browser_name'];

    public function link()
    {
        return $this->belongsTo('App\Link', 'id', 'link_id');
    }

}
