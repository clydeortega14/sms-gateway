<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telcoms extends Model
{
    protected $table ='telcom';
    protected $fillable = ['prefix', 'telcom'];
}
