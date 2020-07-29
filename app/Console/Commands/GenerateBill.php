<?php

namespace App\Console\Commands;

use DB;
use Carbon\Carbon;
use App\Payment;
use App\Outbox;
use App\Credentials;
use App\Bills;
use App\Invoice;
use App\Usage;
use Illuminate\Console\Command;


class GenerateBill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:bill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To Compute Monthly Bill of Postpaid Clients';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        $generate = DB::table('credentials')
        ->join('payments', 'payments.credentials_id', '=', 'credentials.id')
        ->join('invoices', 'invoices.payment_id', '=', 'payments.id')->where('date_expire',null)->get();
        // dd($generate);


        foreach($generate as $gen)
        {
            if($gen->status == 1){
                if($gen->subscription == 2){
                     $today = Carbon::now()->toDateString();
                     $expiry = Carbon::parse($gen->date_start)->addMonth()->toDateString();
                     $date_start = Carbon::parse($gen->date_start)->toDateString();


                    if ($expiry == $today ){
                        

                        $calculate = Outbox::where('invoice_number',$gen->invoice_number)->whereBetween('created_at',[$date_start, $expiry])->count();
                        $update_status = Payment::where('credentials_id', $gen->credentials_id)->where('status', 1)->update(array('date_expire'=>$today,'status'=> 2, 'email_status'=>1));
                        $payment = Payment::where('date_expire', "<>" ,null)->orderBy('id', 'desc')->first();
                        $invoice = Invoice::where('payment_id', $payment->id)->first();
                        $bills = Bills::create(['credentials_id'=>$gen->credentials_id, 'invoice_id'=>$invoice->id, 'amount'=>$gen->amount, 'total_count'=>$calculate, 'status'=>1, 'date_started'=>$gen->date_start, 'date_ended'=>$expiry]);
                        if($bills){
                           
                           try{
                              $id = Payment::orderBy('id', 'desc')->first();
                              if($id == null){
                                $p_id = 1;
                              }else{
                                $p_id = $id->id+1;
                              }
                              $new_payment = Payment::create(['credentials_id'=>$gen->credentials_id, 'amount'=>$gen->amount, 'date_start'=>$today, 'description'=>$gen->description, 'status'=>1]);
                              $new_invoice = Invoice::create(['payment_id'=>$new_payment->id, 'invoice_number'=>Date('Ymd').'-'.$gen->credentials_id.'-'.$p_id, 'status'=>1]);
                              $new_usages = Usage::create(['credentials_id'=>$gen->credentials_id, 'payment_id'=>$new_payment->id, 'invoice_number'=>$new_invoice->invoice_number, 'total_text'=>0]);


                           }catch(\Exception $e){
                            Flash::error("Error!");
                           }
                       }
                   }
               }
           }
        }
     }
}