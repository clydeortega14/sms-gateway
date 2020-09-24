<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Traits\ClientsTrait;
use App\Http\Traits\MessagesTrait;

class MessagesController extends Controller
{
    use ClientsTrait, MessagesTrait;
    
    /**
      * Handle SMS Sending API
      * @param \Illuminate\Http\Request $request
      * @return \Illuminate\Http\Response
    */

    public function textBlastSend(Request $request)
    {        
        DB::beginTransaction();

        try {
            // Globe Sender
            // $this->globeSender($messages);

            // Process of sending message
            $this->processMessage($request->message);

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Message has been sent!'], 200);
            
        } catch (Exception $e) {
            
            DB::rollback();

            return response()->json(['error' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
