<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status_id','username', 'email', 'password', 'name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRoles()
    {
        return $this->hasMany('App\RoleUser','user_id','id');
    }
    public function informations()
    {
        return $this->belongsTo('App\Informations', 'information_id', 'id');
    }
    public function getBranch()
    {
        return $this->belongsTo('App\Branch', 'user_id', 'id');
    }
    public function status()
    {
        return $this->hasOne('App\Status', 'id', 'status_id');
    }
    public function credentials()
    {
        return $this->hasOne('App\Credentials');
    }
}
