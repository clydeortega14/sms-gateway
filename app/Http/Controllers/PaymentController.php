<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Credentials;
use App\Invoice;
use App\Receipt;
use App\Outbox;
use App\Branch;
use App\Usage;
use App\User;
use App;
use DB;
use App\Bills;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Gate;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        view()->share([
                        'page_title'=>'Payments'
                    ]);
    }
    public function index()
    {
        #AUTHORIZATION
        if(!Gate::allows('isSuperadmin') && !Gate::allows('isAdmin')){
            abort(404, "Sorry, You can't do this action");
        }

        $credentials = Credentials::all();
        return view('admin.payments', compact('credentials'));
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
    
    public function show_billing_history()
    {
        if(!Gate::allows('isHeadOffice')){
            abort(404, "Sorry, You can't do this action");
        }

    	$user = auth()->user(); #get authenticated user
        $credential = $user->credentials;
        $bills = Bills::where('credentials_id', $credential->id)->where('total_count', '!=', 0)->orderBy('created_at', 'desc')->get();
        $receipts = Receipt::where('credentials_id', $credential->id)->orderBy('created_at', 'desc')->get();
        
        return view('headoffice.subscription.billing_history', compact('bills', 'receipts'));
    }


    public function view_payment($id)
    {
    	$users = auth()->user(); #get authenticated user

        /*Join table credentials and branches to get data from authenticated user*/
        $getUser_credential = DB::table('credentials')
            ->join('branches', 'credentials_id', '=', 'branches.credentials_id')
            ->select('credentials.*', 'branches.*')
            ->where('branches.user_id', '=', $users->id)
            ->get();

        /*if TRUE*/
        if($getUser_credential)
        {

            /*Join Table Payments and Receipt of authenticated user where Receipt ID equals to specific row ID*/
            $getUser_payment = DB::table('payments')
            ->join('receipts', 'payment_id', '=', 'receipts.payment_id')
            ->select('payments.*', 'receipts.*')
            ->where('receipts.id', '=', $id)
            ->get();

            foreach($getUser_payment as $payment)
            {
                $get_receipt = Receipt::where('payment_id', $payment->id)->where('id', $id)->get();

                $pdf = App::make('dompdf.wrapper');
                $pdf->loadView('pdf/receiptpayment', compact('get_receipt', 'users'));
                return $pdf->stream('payment.pdf');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Gate::allows('isSuperadmin')){
            abort(404, "Sorry, You can't do this action");
        }

        try{
            $invoice = new Invoice;
            $pay = new Payment;
            $usage = new Usage;
            $id = Payment::orderBy('id', 'desc')->first();
            if($id == null){
                $p_id = 1;
            }else{
                $p_id = $id->id+1;
            }
            /*INSERTING DATA TO PAYMENT*/
            $pay->credentials_id = $request->input('credentials_id');
            $pay->amount = $request->input('amount');
            $pay->date_start = $request->input('date_start');
            $pay->date_expire = $request->input('date_expire');
            $pay->description = $request->input('description');
            $pay->status = 1;
            $pay->save();
            /*END*/

            /*INSERTING DATA TO INVOICE*/
            $invoice->payment_id = $pay->id;
            $invoice->status = 1;
            $invoice->invoice_number = Date('Ymd') . '-' . $request->input('credentials_id') .'-' . $p_id;
            $invoice->save();
            /*END*/

            /*INSERTING DATA TO USAGE*/
            $usage->payment_id = $pay->id;
            $usage->credentials_id = $pay->credentials_id;
            $usage->invoice_number = $invoice->invoice_number;
            /*Condition to get Credentials Details*/
            $credentials = Credentials::where('id', $request->input('credentials_id'))->get();
            foreach($credentials as $cre){
                if($cre->subscription == 1){
                    $usage->total_text = ($request->input('amount') / $cre->text_rate);
                }else{
                    $usage->total_text = 0;
                }
            }
            $usage->save();
            // /*END*/

     }catch(\Exception $e) {
        Flash::error("Error!");
            }
    return back()->with('message','Payments Information Successfully save!');
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
        //
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


    /*---------- Billing History OLD CODE ----------------*/

        //     $getUser_branch = Branch::all()->where('user_id', $user->id)->first(); #get authenticated branch
        // $getUser_credential = Credentials::where('id', $getUser_branch->credentials_id)->get(); #get authenticated branch credentials for main
        // $dateToday = new Carbon;
        // if($getUser_credential)
        // {
        //     $get_credential = Credentials::all()->where('id', $getUser_branch->credentials_id)->first();
        //     $getUser_payment = Payment::where('credentials_id', $get_credential->id)->orderBy('id', 'desc')->get();

        //     foreach ($getUser_payment as $payment)
        //     {
        //         foreach($getUser_credential as $credential){
        //             if($credential->subscription == 1){
        //                 if($dateToday > $payment->date_expire || $payment->getUsage->total_charge == $payment->amount)
        //                 {
        //                     Payment::where('id', $payment->id)->update(['status' => 2]);
        //                     Usage::where('payment_id', $payment->id)->update(['total_text' => 0]);
        //                 }
        //             }

        //     /*----------- POSTPAID ----------- */
        //         $getAuth_payment = Payment::where('credentials_id', $get_credential->id)->get();
        //         $getAuth_invoice = Invoice::where('payment_id', $payment->id)->get();

        //         $get_receipt = Receipt::where('credentials_id', $get_credential->id)->orderBy('created_at', 'DESC')->get();


        //             for ($i=0; $i < count($getAuth_invoice); $i++)
        //             {
        //                 $get_outbox = Outbox::where('invoice_number', $getAuth_invoice[$i]['invoice_number'])->get();
        //                 $getAuth_invoice[$i]['count'] = count($get_outbox);

        //                 Usage::where('payment_id', $payment->id)->update(['total_charge' => $getAuth_invoice[$i]['count'] * $get_credential->text_rate]);
        //             }

        //     /*---------------------------*/
        //     $generate = DB::table('credentials')
        //     ->join('payments', 'payments.credentials_id', '=', 'credentials.id')->get();
        //      foreach($generate as $gen)
        //         {
        //             if($gen->subscription == 2){
        //                 $today = Carbon::now()->addMonth()->toDateString();

        //                 $expiry = Carbon::parse($gen->date_start)->addMonth()->toDateString();
        //                 $date_start = Carbon::parse($gen->date_start)->toDateString();
        //                 $calculate = Outbox::where('credentials_id', $gen->id)->whereBetween('created_at',[$date_start, $expiry])->count();
        //                 // dd($expiry, $today);
        //             }
        //         }

        //           $get_invoice = Invoice::where('payment_id', $payment->id)->orderBy('id', 'desc')->get();

        //             for ($i=0; $i < count($get_invoice); $i++) {

        //                 $count_outbox = Outbox::where('invoice_number', $get_invoice[$i]['invoice_number'])->whereBetween('created_at',[$date_start, $expiry])->get()->toArray();
        //                 $get_invoice[$i]['count'] = count($count_outbox);
        //              }

        //                 return view('headoffice.subscription.billing_history')
        //                     ->with('invoice',$getAuth_invoice)
        //                     ->with('get',$get_invoice)
        //                     ->with('receipt',$get_receipt)
        //                     ->with('payments',$getAuth_payment)
        //                     ->with('user_payment',$getUser_payment)
        //                     ->with('credentials', $getUser_credential);
        //         }
        //     }
        // }
        // return redirect('head-office-dashboard')
        //     ->with('user_payment', $getUser_credential);

    /*---------- END BILLING HISTORY OLD CODE ------------*/
}
