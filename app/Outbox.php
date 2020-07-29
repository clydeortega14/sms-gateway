<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outbox extends Model
{
    protected $table = 'outboxes';
    protected $fillable = ['invoice_number', 'sent_message_id', 'credentials_id', 'branch_id', 'number', 'message'];
    protected $dates = ['created_at'];

    public function getBranch()
    {
        return $this->belongsTo('App\Branch', 'id', 'branch_id');
    }
    public function credential()
    {
        return $this->belongsTo('App\Credential', 'credentials_id');
    }

}
