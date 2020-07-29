<?php

namespace App\Console\Commands;

use DB;
use App\Receipt;
use App\Mail\ReceiptStatement;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;

class ReceiptStatements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'receipt:statement';

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
        $receipt = Receipt::where('credentials_id', $user->id)->where('status',1)->first();

            if($receipt !=null){
                Mail::to($user->email)->send(new ReceiptStatement($user,$receipt));
                $update = Receipt::where('credentials_id', $user->id)->update(array('status'=> 2));
            }
         }
    }
}
