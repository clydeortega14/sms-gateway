<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SentMessage;

class MessagesController extends Controller
{
    public function textBlastSend(Request $request)
    {
    	// Create Sent Message
    	$sent = SentMessage::create([

    		'invoice_number' => $request->invoice_number,
    		'credentials_id' => $request->credentials_id,
    		'branch_id' => $request->branch_id,
    		'number' => $request->number,
    		'message' => $request->message

    	]);

    	return response()->json(['status' => 'success', 'message' => 'Message has been sent!', 'data' => $sent], 200);
    }
}
