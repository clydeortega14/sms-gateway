<?php

namespace App\Http\Traits;

use App\Message;
use Globe;

trait MessagesTrait {

	protected function globeSender($message)
    {
        return Globe::send(request()->mobile_number, $message, $this->tokenCode()->passphrase, $this->tokenCode()->app_id, $this->tokenCode()->app_secret, $this->tokenCode()->short_code);
        
    }
    protected function createMessage($message){


        return Message::create([

            'client_id' => $this->tokenCode()->client_id,
            'branch_id' => $this->branch()->id,
            'mobile_number' => request()->mobile_number,
            'message' => $message,
            'status' => 1

        ]);
    }

    protected function messageLoop($messages)
    {
        foreach($messages as $msg){

            $this->createMessage($msg);
        }
    }
}