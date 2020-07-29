<?php

namespace App\Http\Controllers;

use App\Credentials;
use App\Receipt;
use App\Invoice;
use App\Usage;
use App\Bills;
use Gate;
use App;
use DB;
use Illuminate\Http\Request;

class ReceiptController extends Controller
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

        // dd($credentials);          
        $invoice = Bills::where('status', 1)->get();


        return view('admin.receipt', compact('credentials', 'invoice'));
    }

    public function store(Request $request)
    {
            try{
                $receipt = new Receipt;
                $id = Receipt::orderBy('id', 'desc')->first();
                if($id == null){
                    $p_id = 1;
                }else{
                    $p_id = $id->id+1;
                }
                /*INSERTING DATA TO RECEIPT*/

                $receipt->credentials_id = $request->input('credentials_id');
                $receipt->invoice_number = $request->input('invoice_number');
                $receipt->or_number = Date('Ymd').$request->input('credentials_id').$p_id;
                $receipt->amount = $request->input('amount');
                $receipt->description = $request->input('description');
                $receipt->remarks = $request->input('remarks');
                $receipt->status = 1;

                $get_id = Invoice::where('invoice_number', $receipt->invoice_number)->pluck('id')->toArray();

                Bills::where('invoice_id', $get_id)->update(['status'=>2]);
                
                $receipt->save();
             

                $invoice = Invoice::where('invoice_number', $request->input('invoice_number'))->update(['status'=>2]);





                // /*END*/

        }catch(\Exemption $e) {
            Flash::error("Error!");
        }
        return back()->with('msg', 'Payments Successfully save!');
    }

      public function view_receipt_postpaid($id)
    {
             $users = auth()->user(); #get authenticated user


             $getUser_credential = DB::table('credentials')
            ->join('branches', 'credentials_id', '=', 'branches.credentials_id')
            ->select('credentials.*', 'branches.*')
            ->where('branches.user_id', '=', $users->id)
            ->get();


            foreach($getUser_credential as $r){

                $receipt = Receipt::where('credentials_id', $r->credentials_id)->where('id', $id)->get();


                $pdf = App::make('dompdf.wrapper');
                $pdf->loadView('pdf/postreceipt', compact('users','receipt'));
                return $pdf->stream('payment.pdf');
                 }


    }



     public function edit($id)
    {
        $receipt = Receipt::findorFail($id);

        return view('admin.edit_bill', ['receipt' => $receipt]);
    }

    public function update(Request $request, $id)
    {
        $receipt = Receipt::find($id);


        $receipt->id = $request->input('id');
        $receipt->credentials_id = $request->input('credentials_id');
        $receipt->invoice_number = $request->input('invoice_number');
        $receipt->or_number = $request->input('or_number');
        $receipt->status = $request->input('status');
        $receipt->amount = $request->input('amount');
        $receipt->description = $request->input('description');
        $receipt->remarks = $request->input('remarks');
        $receipt->save();


         return redirect('/clients-billing-statements');
    }

    public function invoiceTotalUsage(Request $request)
    {

        $data = Usage::where('invoice_number',$request->id)->first();
        if(!is_null($data)){

            $invoice = Invoice::where('invoice_number', $data->invoice_number)->pluck('id')->toArray();
            $bills = Bills::where('invoice_id', $invoice)->get();
            foreach($bills as $bill){
                $final_bill = $data->total_charge < $bill->amount ? $bill->amount : $data->total_charge;
                return number_format((float)$final_bill);
            }

        }

        
    }

}

