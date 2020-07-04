<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['user_id', 'ip', 'url', 'custom', 'total_uses', 'used', 'expire_at', 'active'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    public function linkStats()
    {
        return $this->hasMany('App\LinkStats', 'link_id', 'id');
    }

}
