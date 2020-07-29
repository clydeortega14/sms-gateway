<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informations extends Model
{
    protected $table = 'informations';
    protected $fillable = ['branch_id', 'company', 'address', 'zip_code'];
    protected $primaryKey = 'id';

    public function getBranch()
    {
    	return $this->belongsTo('App\Branch', 'id', 'branch_id');
    }
    public function users()
    {
    	return $this->belongsTo('App\User');
    }
    public function branches()
    {
        return $this->hasOne('App\Branch', 'branch_id', 'id');
    }
}
