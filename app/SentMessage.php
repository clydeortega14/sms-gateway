<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentMessage extends Model
{
    protected $table = 'sent_message';
    protected $fillable = ['invoice_number', 'credentials_id', 'branch_id', 'number', 'message'];
    protected $dates = ['created_at'];

    public function getBranch()
    {
        return $this->belongsTo('App\Branch', 'id', 'branch_id');
    }
    public function credential()
    {
        return $this->belongsTo('App\Credential', 'credentials_id');
    }
    public function getSent()
    {
        return $this->hasMany('App\Outbox', 'sent_message_id', 'id');
    }

}
