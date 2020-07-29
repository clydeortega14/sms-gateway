<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    protected $table = 'usages';
    protected $fillable = ['credentials_id','payment_id', 'invoice_number', 'total_text', 'total_charge'];

    public function getPayment()
    {
    	return $this->belongsTo('App\Payment', 'payment_id', 'id');
    }
}
