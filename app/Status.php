<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    protected $fillable = ['name','class'];

    public $timestamps = false;

    public function users()
    {
    	return $this->belongsTo('App\User');
    }
}
