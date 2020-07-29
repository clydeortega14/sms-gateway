<?php

namespace App\Http\Controllers;

use Globe\Globe;
use App\Credentials;
use App\Payment;
use App\Usage;
use App\Outbox;
use App\Invoice;
use App\User;
use App\Branch;
use App\Bills;
use App\SentMessage;
use App\Telcoms;
use App\SendMessageLog;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        view()->share([
            'page_title'=>'Messages'
        ]);
    }

    public function send(Request $request) {

        $access_token = null;
        $short_code = null;
        $branch_id = null;
        $number = null;
        $message = null;

        try {
            foreach(json_decode($request->getContent(), true) as $msg) {

                $access_token = $msg['AccessToken'];
                $short_code = $msg['ShortCode'];
                $branch_id = $msg['BranchId'];
                $number = $msg['Number'];
                $message = $msg['Message'];

                $this->sendMessage($access_token, $short_code, $branch_id, $number, $message);

            }
        } catch(\Exception $e) {
            SendMessageLog::create([
                'log_type_id' => 1,
                'log_message' => $e->getMessage(),
                'recipient_number' => $number,
                'access_token' => $access_token,
                'short_code' => $short_code,
                'branch_id' => $branch_id,
                'message' => $message
            ]);

        }

        return response()->json([
            'status'=>'OK'
        ]);
    }

    public function showSentMessagesJson() {
        $user = auth()->user();
        $branch = Branch::where('user_id', $user->id)->first();

        $sent_messages = SentMessage::where('credentials_id', $branch->credentials_id)->orderBy('id', 'DESC')->orderBy('created_at', 'DESC');
    
        return datatables($sent_messages)->make(true);
    }
       
    public function showSentMessages()
    {
        return view('headoffice.outbox');
    }

    public function otpsender(Request $request)
    {
        try {
            $access_token = $request['AccessToken'];
            $short_code = $request['ShortCode'];
            $branch_id = $request['BranchId'];
            $number = $request['Number'];
            $message = $request['Message'];

            $this->sendMessage($access_token, $short_code, $branch_id, $number, $message);
        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

        return response()->json([
            'status'=>'OK'
        ]);
    }

    public function sendMessage($access_token, $short_code, $branch_id, $number, $message)
    {
        $access = Credentials::where('access_token', $access_token)->first();

        if ($access == null) {
            SendMessageLog::create([
            'log_type_id' => 3,
            'log_message' => 'Invalid token',
            'recipient_number' => $number,
            'access_token' => $access_token,
            'short_code' => $short_code,
            'branch_id' => $branch_id,
            'message' => $message
            ]);

            return response()->json([
                'status'=>'ERROR',
                'description'=>'Invalid Access Token!',
                'number'=>$number,
                'message'=>$message
            ]);
        }

        if ($access->status == 1) {
            $payment = Payment::where([['credentials_id', '=', $access->id], ['status', '=', 1]])->first();
            $usage = Usage::where('payment_id', '=', $payment->id)->first();
            $invoice = Invoice::where('payment_id', '=', $payment->id)->first();

            // POST PAID
            if($access->subscription == 2){
                $response = Globe::send($number, $message, $access->passphrase, $access->app_id, $access->app_secret, $short_code);
                
                if($response->getStatusCode() == 201){
                        $messages = str_split($message, 160);
                        $sent_message = SentMessage::create(['invoice_number'=>$invoice->invoice_number, 'credentials_id'=>$access->id, 'branch_id'=>$branch_id, 'number'=>$number, 'message'=>$message]);

                        foreach($messages as $msg){
                            $outbox = Outbox::create(['invoice_number'=>$invoice->invoice_number, 'sent_message_id'=>$sent_message->id, 'credentials_id'=>$access->id, 'branch_id'=>$branch_id, 'number'=>$number, 'message'=>$msg]);
                            }
                }
                else {
                    SendMessageLog::create([
                        'credential_id' => $access->id,
                        'log_type_id' => 5,
                        'log_message' => '',
                        'recipient_number' => $number,
                        'status_code' => $response->getStatusCode(),
                        'access_token' => $access_token,
                        'short_code' => $short_code,
                        'branch_id' => $branch_id,
                        'message' => $message
                    ]);
                }
            }
            // PREPAID
            // else {

            // }
        }
        else {
            SendMessageLog::create([
                'credential_id' => $access->id,
                'log_type_id' => 4,
                'log_message' => 'Credential status is inactive',
                'recipient_number' => $number,
                'access_token' => $access_token,
                'short_code' => $short_code,
                'branch_id' => $branch_id,
                'message' => $message
            ]);
        }
    }

}

