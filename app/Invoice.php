<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable =['payment_id', 'invoice_number', 'status'];
    protected $dates =['date_expire'];

    public function getPayment()
    {
    	return $this->belongsTo('App\Payment', 'payment_id', 'id');
    }

    public function getBill()
    {
    	return $this->hasOne('App\Bills', 'invoice_id', 'id');
    }
}
