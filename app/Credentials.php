<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credentials extends Model
{
    protected $table = 'credentials';
    protected $fillable = [
        'user_id', 
        'access_token', 
        'passphrase', 
        'app_id', 
        'app_secret', 
        'text_rate', 
        'subscription', 
        'status'
    ];

    public function getStatus()
    {
        return $this->hasOne('App\Status', 'id', 'status');
    }
    public function getSubscription()
    {
        return $this->hasOne('App\SubscriptionType', 'id', 'subscription');
    }
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    // public function branches()
    // {
    //     return $this->hasMany('App\Branch', 'credentials_id');
    // }
    public function outbox()
    {
        return $this->hasOne('App\Outbox', 'credentials_id');
    }
    public function getBill()
    {
        return $this->hasOne('App\Bills', 'credentials_id', 'id');
    }
    public function getPayment()
    {
        return $this->belongsTo('App\Payment', 'credentials_id', 'id');
    }

    public function users()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'credentials_id', 'id');
    }
}
