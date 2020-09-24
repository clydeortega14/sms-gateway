<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{
    protected $guarded = [];

    public function credential()
    {
    	return $this->belongsTo('App\Credentials');
    }
}
