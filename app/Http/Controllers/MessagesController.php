<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Traits\ClientsTrait;
use App\Http\Traits\MessagesTrait;

class MessagesController extends Controller
{
    use ClientsTrait, MessagesTrait;

    public function textBlastSend(Request $request)
    {
    	DB::beginTransaction();

        try {

            $messages = $request->message;
            
            if($this->tokenCode()->status == 1){

                // Globe Sender
                // $this->globeSender($messages);

                // check message length
                if(strlen($messages) > 160){

                    // split message if greater thank 160 characters
                    $split_messages = str_split($messages, 160);
                    // loop message
                    $this->messageLoop($split_messages);
                }else{

                    //Send SMS
                    $this->createMessage($messages);
                }

            }
            
        } catch (Exception $e) {
            
            DB::rollback();

            return response()->json(['error' => 'error', 'message' => $e->getMessage()], 500);
        }

        DB::commit();

    	return response()->json(['status' => 'success', 'message' => 'Message has been sent!'], 200);
    }
}
