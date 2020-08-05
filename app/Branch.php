<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branches';
    protected $fillable = ['client_id', 'branch_name', 'branch_description', 'status'];

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
    public function client()
    {
        return $this->belongsTo('App\Client', 'id');
    }

    public function formatStatus()
    {
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
