<?php

namespace App\Http\Controllers;

use App\User;
use App\Payment;
use App\Usage;
use App\Receipt;
use App\Credentials;
use App\Branch;
use App\Invoice;
use App\Bills;
use Carbon\Carbon;
use DB;
use Datatables;

use Illuminate\Http\Request;

class BillController extends Controller
{

      public function __construct()
    {
        view()->share([
                        'page_title'=>'Billing And Receipt Statements'
                    ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    

        
        $bills = Branch::where('branch_id', 0)->get()->mapWithKeys(function($branch) {
            $user = $branch->getUser->username;
            $credential = $branch->credentials;
            $payments = $credential->payments->where('status', 2)->mapWithKeys(function($payment) use ($credential) {
                $invoice = $payment->getInvoice;
                if(is_null($invoice->getBill)) return[];
                $bill = $invoice->getBill;
                $monthly_bill = $bill->amount;
                $actual_bill = (float) $credential->text_rate * $bill->total_count;
                $final_bill = $actual_bill < $monthly_bill ? $monthly_bill : $actual_bill;
                    return [
                            $payment->getInvoice->invoice_number => 
                            [
                                'bill' => $final_bill,
                                'billing_date' => Carbon::parse($bill->date_ended)->format('Y/m/d')
                            ]
                    ];
                });
            return [ $user => $payments];
            
            return [$branch->id => [$branch->getUser->username => $branch->credentials->text_rate] ];
        });
        // $bills = Bills::all()->mapWithKeys(function($bill) {
            // return [$bill]
        // });
        // $credentials = Credentials::all()->toArray();
        // dd($credentials, $bills);
        //     $users = DB::table('users')
        //     ->select('users.id as userid',
        //         'users.username',
        //         'credentials.id as cred_id',
        //         'payments.id as pymt_id',
        //         'invoices.id as inv_id',
        //         'invoices.invoice_number',
        //         'bills.*')
        //     ->join('credentials','credentials.user_id', '=', 'users.id')
        //     ->join('bills', 'bills.credentials_id','=','credentials.id')
        //     ->join('payments', 'payments.credentials_id', '=', 'credentials.id')
        //     ->join('invoices', 'invoices.payment_id', '=', 'payments.id')
            // ->join('branches', 'branches.user_id', '=', 'users.id')
            // ->where('branch_id', 0)
            // ->orderBy('date_started', 'DESC')
            // ->get();
            // dd($users);
            // $bills = DB::table('users')
            //  ->join('credentials','credentials.user_id', '=', 'users.id')
            //  ->join('receipts', 'receipts.credentials_id', '=','credentials.id')
            //  ->join('branches', 'branches.user_id', '=', 'users.id')->where('branch_id', 0)->get();

            $receipt = Receipt::all();


             return view('admin.client_bill_info')
             ->with('bills', $bills)
             // ->with('user', $users)
             ->with('receipt', $receipt);
    }

    public function usersList()
    {
       $users = DB::table('users')
            ->join('credentials','credentials.user_id', '=', 'users.id')
            ->join('bills', 'bills.credentials_id','=','credentials.id')
            ->join('branches', 'branches.user_id', '=', 'users.id')->where('branch_id', 0)->orderBy('date_started', 'DESC')->get();


           // foreach($users as $user){
           //  dd($user->name);
           // }
        return datatables()->of($users)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
