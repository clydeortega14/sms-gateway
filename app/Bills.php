<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    protected $table ='bills';
    protected $fillable = ['credentials_id', 'invoice_id', 'amount', 'total_count', 'status', 'date_started', 'date_ended'];
    protected $dates = ['created_at', 'updated_at', 'date_ended'];

     public function getCredential()
    {
        return $this->belongsTo('App\Credentials', 'credentials_id', 'id');
    }

    public function textRate()
    {
    	if(!$this->hasCredentials()) return;
    	return (float) ($this->total_count * (int) $this->getCredential->text_rate);
    }

    // public function 

    public function hasCredentials()
    {
    	return !is_null($this->getCredential);
    }

    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'invoice_id', 'id');
    }

}
