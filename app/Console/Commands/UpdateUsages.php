<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Credentials;
use App\Payment;
use App\Invoice;
use App\Usage;
use Carbon\Carbon;

class UpdateUsages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:usages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Client Text Usages';

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
        $credentials = Credentials::all();
        $invoice = Invoice::all();
        $payment = Payment::all();
        $dateToday = new Carbon;
        
            $outbox = DB::table('outboxes')
                ->select('invoice_number', DB::raw('count(*)as total_usage'))
                ->groupBy('invoice_number')
                ->get();

        foreach ($payment as $pay) {
            foreach ($outbox as $out){
                foreach ($credentials as $cre){
                    foreach ($invoice as $in){

                        if($cre->subscription == 1){
                            if($dateToday >= $pay->date_expire || $out->total_usage == $pay->getUsage->total_charge){
                                    Payment::where('id', $pay->id)->update(['status' => 2]);
                                    Usage::where('payment_id', $pay->id)->update(['total_text' => 0]);
                            }
                            else{
                                if($out->invoice_number == $in->invoice_number){
                                        DB::table('usages')
                                            ->where('credentials_id', $cre->id)
                                            ->where('invoice_number', $in->invoice_number)
                                            ->update(['total_charge' => $out->total_usage * $cre->text_rate]);
                                }
                            }
                        }elseif ($cre->subscription == 2){
                           if($out->invoice_number == $in->invoice_number){
                                        DB::table('usages')
                                            ->where('credentials_id', $cre->id)
                                            ->where('invoice_number', $in->invoice_number)
                                            ->update(['total_charge' => $out->total_usage * $cre->text_rate]);
                            }
                        }
                    }
                }
            }
        }
    }
}
