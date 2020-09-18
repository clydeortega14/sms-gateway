<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];


    public function client()
    {
    	return $this->belongsTo('App\Client');
    }
    public function branch()
    {
    	return $this->belongsTo('App\Branch');
    }
    public function status()
    {
    	return $this->hasOne('App\MessageStatus');
    }
}
