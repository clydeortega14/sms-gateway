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

    public function index()
    {
        //
    }
    public function send(Request $request)
    {
        $access_token = Crypt::decryptString($request->input('access_token'));
        $branch_id = Crypt::decryptString($request->input('branch_id'));
        $number = Crypt::decryptString($request->input('number'));
        $message = Crypt::decryptString($request->input('message'));
        $short_code = Crypt::decryptString($request->input('short_code'));

        $data = Telcoms::all()->pluck('prefix')->toArray();
        $telco = substr($number, 0, 4);


        if(in_array($telco, $data)){

            $access = Credentials::where('access_token', $access_token)->where('status', 1)->first();

            if($access != null){

                $payment = Payment::where([['credentials_id', '=', $access->id], ['status', '=', 1]])->first();
                $usage = Usage::where('payment_id', '=', $payment->id)->first();
                $invoice = Invoice::where('payment_id', '=', $payment->id)->first();

                /*POSTPAID*/
                if($access->subscription == 2){
                    $send = Globe::send($number, $message, $access->passphrase, $access->app_id, $access->app_secret, $short_code);

                    if($send->getStatusCode() == 201){
                       /*Inserting Sent Messages*/
                       $messages = str_split($message, 160);

                       $sent_message = SentMessage::create(['invoice_number'=>$invoice->invoice_number, 'credentials_id'=>$access->id, 'branch_id'=>$branch_id, 'number'=>$number, 'message'=>$message]);

                       foreach($messages as $msg){
                        /*Updating total_text*/
                        $outbox = Outbox::create(['invoice_number'=>$invoice->invoice_number, 'sent_message_id'=>$sent_message->id, 'credentials_id'=>$access->id, 'branch_id'=>$branch_id, 'number'=>$number, 'message'=>$msg]);
                    }
                    /*Return Success*/
                    return response()->json([
                        'status'=>'OK',
                        'description'=>'Message Sent!',
                        'number'=>$request->input('number'),
                        'message'=>Crypt::decryptString($request->input('message'))
                    ]);

                }else{
                   /*Return ERROR*/
                   return response()->json([
                    'status'=>'ERROR',
                    'description'=>'Message Error!',
                    'number'=>$request->input('number'),
                    'message'=>Crypt::decryptString($request->input('message'))
                ]);
               }

           }
           /*END POSTPAID*/
       }
   }else{
     /*Return ERROR*/
     return response()->json([
        'status'=>'ERROR',
        'description'=>'Message Error!',
        'number'=>$request->input('number'),
        'message'=>Crypt::decryptString($request->input('message'))
    ]);
 }


}


    public function show()
    {
            $users = User::all();
            $cren = auth()->user();
            $branch = Branch::where('user_id',$cren->id)->get();

            foreach($branch as $br){
               $posts = DB::table('outboxes')
               ->select('credentials_id', DB::raw('count(*) as totals'))
               ->groupBy('credentials_id')
               ->get()->toArray();

               $outbox = SentMessage::where('credentials_id', $br->credentials_id)->orderBy('id', 'DESC')->orderBy('created_at', 'DESC')->get();

           }

         return view('headoffice.outbox')
         ->with('users',$users)
         ->with('outbox',$outbox);
    }
}
//             /*PREPAID*/
//                      if($access->subscription == 1){
//                             if($usage->total_text > 0){
//                                // $send = Globe::send($number, $message, $access->passphrase, $access->app_id, $access->app_secret, $short_code);

//                                 /*Inserting Sent Messages*/
//                                 $messages = str_split($message, 160);

//                                 $sent_message = SentMessage::create(['invoice_number'=>$invoice->invoice_number, 'credentials_id'=>$access->id, 'branch_id'=>$branch_id, 'number'=>$number, 'message'=>$message]);

//                                 foreach($messages as $msg){
//                                     /*Updating total_text*/
//                                     $outbox = Outbox::create(['invoice_number'=>$invoice->invoice_number, 'sent_message_id'=>$sent_message->id, 'credentials_id'=>$access->id, 'branch_id'=>$branch_id, 'number'=>$number, 'message'=>$msg]);
//                                 }

//                                      $new_val = $usage->total_text - count($messages);
//                                      $update = Usage::where('invoice_number',$invoice->invoice_number)->update(array('total_text'=>$new_val));

//                                try{
//                                     /*Return Success*/
//                                     return response()->json([
//                                         'status'=>'OK',
//                                         'description'=>'Message Sent!',
//                                         'number'=>$request->input('number'),
//                                         'message'=>Crypt::decryptString($request->input('message'))
//                                     ]);
//                                 }catch(\Exception $e){
//                                      /*Return ERROR*/
//                                     return response()->json([
//                                         'status'=>'ERROR',
//                                         'description'=>'Message Error!',
//                                         'number'=>$request->input('number'),
//                                         'message'=>Crypt::decryptString($request->input('message'))
//                                     ]);
//                                 }
//                             }
//                                     else{
//                                          $state = Credentials::where('id', $access->id)->update(array('status'=> 2));
//                                          $states = Payment::where('id', $payment->id)->update(array('status'=> 2));
//                                          $calculate = Outbox::where('invoice_number',$invoice->invoice_number)->count();
//                                          Bills::create(['credentials_id'=>$access->id, 'total_count'=>$calculate, 'status'=>2, 'date_started'=>$payment->date_start, 'date_ended'=>$payment->date_expire]);
//                                      }
//                             }
// /*--------- END PREPAID ---------*/