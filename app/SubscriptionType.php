<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionType extends Model
{
    protected $table = 'subscription_type';
    protected $fillable = ['name', 'class' ];
    public $timestamps = false;

}
