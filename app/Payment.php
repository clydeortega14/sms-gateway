<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'credentials_id', 
        'amount',
        'date_start', 
        'date_expire', 
        'description', 
        'status', 
        'email_status'];
    protected $dates = ['date_start', 'date_expire'];


    public function getCredentials()
    {
        return $this->hasOne('App\Credentials', 'id', 'credentials_id');
    }
    public function getStatus()
    {
        return $this->hasOne('App\Status', 'id', 'status');
    }
     public function getInvoice()
    {
        return $this->belongsTo('App\Invoice', 'id', 'payment_id');
    }
    public function getUsage()
    {
        return $this->belongsTo('App\Usage', 'id', 'payment_id');
    }
    public function getReceipt()
    {
        return $this->belongsTo('App\Receipt', 'id', 'payment_id');
    }
     public function getCredential()
    {
        return $this->belongsTo('App\Credentials', 'credentials_id', 'id');
    }


}
