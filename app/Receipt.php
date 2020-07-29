<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $table = 'receipts';
    protected $fillable = ['credentials_id', 'or_number', 'amount','description', 'remarks', 'invoice_number'];

    public function getCredentials()
    {
    	return $this->belongsTo('App\Credentials', 'credentials_id', 'id');
    }

    public function getInvoice()
    {
    	return $this->belongsTo('App\Invoice', 'invoice_id', 'id');
    }
}
