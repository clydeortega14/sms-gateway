<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name', 'display_name', 'description'];
    public $timestamps = false;

    public function getRoles()
    {
    	return $this->hasMany('App\RoleUser', 'role_id', 'id');
    }
}
