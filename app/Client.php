<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = ['name', 'description', 'email', 'contact_number', 'address', 'status'];

    public function branches()
    {
    	return $this->hasMany('App\Branch', 'client_id');
    }
}
