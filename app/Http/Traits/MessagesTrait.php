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
            'branch_id' => $this->branch(),
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

    protected function processMessage($messages)
    {
        /*
            * Split messages if characters length is greater than 160
        */
        if(strlen($messages) > 160){

            // Split messages
            $split_messages = str_split($messages, 160);
            // Store message in database with the array of splitted message
            $this->messageLoop($split_messages);
        }else{

            $this->createMessage($messages);
        }
    }
}