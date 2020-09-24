<?php

namespace App\Http\Traits;

use App\Message;
use Globe;

trait MessagesTrait {

    /**
      * Globe API Sms Sender Service
      * @param $message
    */
	protected function globeSender($message)
    {
        return Globe::send(request()->mobile_number, $message, $this->tokenCode()->passphrase, $this->tokenCode()->app_id, $this->tokenCode()->app_secret, $this->tokenCode()->short_code);
        
    }
    /**
      * Create Message and store it in the database
      * @param \Illuminate\Http\Request $request
      * @param \ $message
    */
    protected function createMessage($message)
    {
        return Message::create([

            'client_id' => $this->tokenCode()->client_id,
            'branch_id' => $this->branch(),
            'mobile_number' => request()->mobile_number,
            'message' => $message,
            'status' => 1

        ]);
    }
    /**
      * Handle array og messages
      * @param messages
    */
    protected function messageLoop($messages)
    {
        foreach($messages as $msg){

            $this->createMessage($msg);
        }
    }

    /**
      * Handle Message to be stored in the database
      * @param messages
    */

    protected function processMessage($messages)
    {
        // Check if message length is greater than 160 characters
        if(strlen($messages) > 160){
            // Split messages
            $split_messages = str_split($messages, 160);
            // Store message in database with the array of splitted message
            $this->messageLoop($split_messages);
        }else{
            // Store directly to database
            $this->createMessage($messages);
        }
    }
}