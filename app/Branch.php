<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    protected $fillable = ['user_id', 'credentials_id', 'branch_id', 'branch_name'];

    public function getUser()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }
    public function credentials()
    {
    	return $this->hasOne('App\Credentials', 'id', 'credentials_id');
    }
    public function informations()
    {
        return $this->belongsTo('App\Informations', 'id', 'branch_id');
    }

    public function getOutboxes()
    {
        return $this->hasMany('App\Outbox', 'branch_id', 'branch_id');
    }
}
