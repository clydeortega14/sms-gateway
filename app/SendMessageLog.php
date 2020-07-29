<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendMessageLog extends Model
{
    protected $table = 'send_message_logs';

    protected $fillable = [
        'credential_id' ,
        'log_type_id',
        'log_message',
        'recipient_number',
        'status_code',
        'access_token',
        'short_code',
        'branch_id',
        'message'
    ];
}
