<?php

namespace App\Console\Commands;

use DB;
use App\Payment;
use App\credentials;
use App\Mail\BillStatement;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class BillStatements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bill:statement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending Receipt Statement';

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
        $users = DB::table('users')
         ->join('credentials','credentials.user_id','=','users.id')
         ->join('branches','branches.user_id','=','users.id')->where('branch_id',0)->get();

        foreach($users as $user){
        $payment = Payment::where('credentials_id', $user->id)->where('email_status', 1)->first();

            if($payment!=null){
             Mail::to($user->email)->send(new BillStatement($user,$payment));

             $pays = Payment::where('credentials_id', $user->id)->where('email_status', 1)->get();
                 foreach($pays as $pay){
                    $update = Payment::where('id', $pay->id)->update(array('email_status'=>2));
                 }
            }
        }
    }
}
