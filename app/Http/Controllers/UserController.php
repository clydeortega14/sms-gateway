<?php

namespace App\Http\Controllers;

use App\User;
use App\Informations;
use App\Credentials;
use App\Invoice;
use App\Usage;
use App\Outbox;
use App\Payment;
use App\Branch;
use App\Receipt;
use App\SubscriptionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Gate;
use App\Bills;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        view()->share([
            'page_title'=>'Dashboard'
        ]);
    }


    public function index()
    {
        #ATHORIZATION
        if(!Gate::allows('isSuperadmin') && !Gate::allows('isAdmin'))
        {
            abort(404, "Sorry, You can't do this action");
        }


        $invoice = Invoice::all();
        $credentials = Credentials::all();
        $usage = Usage::all();
        $payment = Payment::all();


        // for ($x = 0; $x < count($invoice); $x++) {
        //     $outsms = Outbox::where('invoice_number', $invoice[$x]['invoice_number'])->get();
        //     $invoice[$x]['count'] = count($outsms);

        // }

        return view('admin.dashboard', compact('invoice', 'credentials', 'usage', 'payment'));



    }

    public function getOutbox($invoice)
    {
        return Outbox::where('invoice_number', $invoice->invoice_number);
    }

    public function getSmsSummary($branches, $invoice, $access)
    {
        $sms_summary = [];

        foreach($branches as $branch){

            $total_sms = $this->getOutbox($invoice)->where('branch_id', $branch->branch_id)->count();

            $sms_summary[] = [

                'branch_name' => $branch->branch_name,
                'total_sms' => $total_sms,
                'charges' => number_format($total_sms * $access->text_rate, 2)
            ];
        }


        return $sms_summary;
    }

    public function head_office()
    {
        #AUTHORIZATION
        if(!Gate::allows('isHeadOffice') && !Gate::allows('isBranch')){
            abort(404, "Sorry, You can't do this action");
        }

        $user = auth()->user([0]);

        // $access = Credentials::where('user_id', $user->id)->get();
        $access = Credentials::where('user_id', $user->id)->first();
        $payment = Payment::where('credentials_id', $access->id)->where('date_expire', null)->first();
        $invoice = Invoice::where('payment_id', $payment->id)->first();
        $branches = Branch::with(['client'])->get();

        // GET SMS SUMMARY FOR EVER BRANCH
        $sms_summary = $this->getSmsSummary($branches, $invoice, $access);
        // GET TOTAL CHARGES OR TOTAL POSTPAID PAYMENT
        $postpaid = number_format($this->getOutbox($invoice)->count() * $access->text_rate, 2);

        return view('headoffice.head-office-dashboard', compact('sms_summary', 'postpaid') );
        


        // $generate = DB::table('credentials')
        // ->join('payments', 'payments.credentials_id', '=', 'credentials.id')->get();
         
        // foreach($access as $access){
        //     if($access->subscription == 1){
        //         /*PREPAID*/
        //         $getUser_branch = Branch::all()->where('user_id', $user->id)->first(); #get authenticated branch
        //         $getUser_credential = Credentials::where('id', $getUser_branch->credentials_id)->get(); #get authenticated branch credentials for main
        //         $get_credential = Credentials::all()->where('id', $getUser_branch->credentials_id)->first();
        //         $getUser_payment = Payment::where('credentials_id', $get_credential->id)->orderBy('id', 'desc')->get();
        //         $getAll_branch = Branch::all();


        //         foreach($getUser_payment as $payment){
        //             $get_payment = Payment::where('id', $payment->id)->where('credentials_id', $get_credential->id)->orderBy('id', 'desc')->get();
        //             $get_invoice = Invoice::where('payment_id', $payment->id)->orderBy('id', 'desc')->get();

        //             for($x = 0; $x < count($get_invoice); $x++){
        //                 $count_outbox = Outbox::where('invoice_number', $get_invoice[$x]['invoice_number'])->get()->toArray();
        //                 $get_invoice[$x]['count'] = count($count_outbox);
        //             }

        //             for($p = 0; $p < count($getAll_branch); $p++){
        //                 for($g = 0; $g < count($get_invoice); $g++){
        //                     $outbox_count = Outbox::where('invoice_number', $get_invoice[$g]['invoice_number'])
        //                     ->where('branch_id', $getAll_branch[$p]['branch_id'])
        //                     ->where('credentials_id', $getAll_branch[$p]['credentials_id'])->get();
        //                     $getAll_branch[$p]['count'] = count($outbox_count);
        //                 }
        //             }
        //             return view('headoffice.head-office-dashboard')
        //             ->with('invoice', $get_invoice)
        //             ->with('branch', $getAll_branch)
        //             ->with('get_payment', $get_payment)
        //             ->with('credentials', $getUser_credential);
        //         }/*END OF FOREACH ($payment)*/

        //     }else{
        //     /*POSTPAID*/
        //     foreach($generate as $gen)
        //         {

        //             if($gen->subscription == 2){

        //                 $today = Carbon::now()->toDateString();
        //                  // dd($today);
        //                 $expiry = Carbon::parse($gen->date_start)->addMonth()->toDateString();
        //                 $date_start = Carbon::parse($gen->date_start)->toDateString();
        //                 $calculate = Outbox::where('credentials_id', $gen->id)->whereBetween('created_at',[$date_start, $expiry])->count();
        //             }
        //         }

        //         $getUser_branch = Branch::all()->where('user_id', $user->id)->first(); #get authenticated branch
        //         $getUser_credential = Credentials::where('id', $getUser_branch->credentials_id)->get(); #get authenticated branch credentials for main
        //         $get_credential = Credentials::all()->where('id', $getUser_branch->credentials_id)->first();
        //         $getUser_payment = Payment::where('credentials_id', $get_credential->id)->orderBy('id', 'desc')->get();
        //         $getAll_branch = Branch::all();

        //         $dateToday = new Carbon;

        //         foreach ($getUser_payment as $payment) {
        //             $get_payment = Payment::where('id', $payment->id)->where('credentials_id', $get_credential->id)->orderBy('id', 'desc')->get();
        //             $get_invoice = Invoice::where('payment_id', $payment->id)->orderBy('id', 'desc')->get();

        //             /*Count TOTAL USAGES*/
        //             for ($i=0; $i < count($get_invoice); $i++) {
        //                 // $count_outbox = Outbox::where('invoice_number', $get_invoice[$i]['invoice_number'])->whereBetween('created_at',[$date_start, $expiry])->get()->toArray();
        //                 $count_outbox = Outbox::where('invoice_number', $get_invoice[$i]['invoice_number'])->get()->toArray();

        //                 $get_invoice[$i]['count'] = count($count_outbox);
        //                 Usage::where('payment_id', $payment->id)->update(['total_charge' => $get_invoice[$i]['count'] * $get_credential->text_rate]);
        //             }

        //             /*END*/

        //             for ($b=0; $b < count($getAll_branch); $b++) {

        //                 for ($in=0; $in < count($get_invoice); $in++) {

        //                     $outbox_count = Outbox::where('invoice_number', $get_invoice[$in]['invoice_number'])
        //                     ->where('branch_id', $getAll_branch[$b]['branch_id'])
        //                     ->where('credentials_id', $getAll_branch[$b]['credentials_id'])
        //                     // ->whereBetween('created_at',[$date_start, $expiry])->get();
        //                     ->get();

        //                     $getAll_branch[$b]['count'] = count($outbox_count);

        //                 }
        //             }
        //             return view('headoffice.head-office-dashboard')
        //                 ->with('invoice', $get_invoice)
        //                 ->with('branch', $getAll_branch)
        //                 ->with('count', $outbox_count)
        //                 ->with('calculate', $calculate)
        //                 ->with('credentials', $getUser_credential)
        //                 ->with('get_payment', $get_payment);
        //         }
        //     }
        // }/*END OF FOREACH ($access)*/
    }
public function view_profile()
{
    $branches = Branch::where('user_id', auth()->user()->id)->get();
    $info = Informations::all();

    foreach($info as $user){

        $informations = Informations::where('branch_id', $user->id)->get();

        return view('users.user-profile')->with('informations', $informations);
    }
}
public function upload_image(Request $request)
{
            #VALIDATION
    $this->validate($request, [
      'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
  ]);
        //upload in database
             #get user ID in BRANCH table
            // $branches = Branch::where('user_id', auth()->user()->id)->get();
            // #get all data in informations table
            // $info = Informations::all();
            // $informations = Informations::where('id', auth()->user()->informations->id)->get();
    if($request->file('image'))
    {
        $filename = rand().'.'.$request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('public/uploads', $filename);
    }
    $informations = Informations::where('id', auth()->user()->informations->id)->update(['image' => $filename]);
    return back();
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function update_status(Request $request, $id)
    {
      #FIND BRANCH_ID
      $branch = Branch::find($id);

      #UPDATE STATUS
      $user_status = User::where('id', $branch->getUser->id)->get();
      foreach($user_status as $status){
        if($status->status_id == 1){

          User::where('id', $branch->getUser->id)->update(['status_id' => 2]);
      }else{
        User::where('id', $branch->getUser->id)->update(['status_id' => 1]);
    }
    return back();
}
}

public function update_user_account(Request $request)
{

    $user_account = User::find(auth()->user()->id);
    $user_account->name     = $request->input('user_fullname');
    $user_account->username = $request->input('username');
    $user_account->email    = $request->input('user_email');
    $user_account->save();

    return redirect('/view-user-profile');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function client_details(Request $id)
    {
        $clients = User::find($id);

        return view('users.client-details', ['clients' => $clients]);
    }

    public function update_user_password(Request $request)
    {
        #VALIDATION
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);

        #MATCHING PASSWORD
        $user_password = User::find(auth()->user()->id);
        $user_password->password = Hash::make($request->input('password'));
        $user_password->save();

        return redirect('/view-user-profile')->with('password-response', 'Password has been Changed!');

    }

    public function update_company_information(Request $request)
    {
        $company_information = User::find(auth()->user()->id);
        $company_information->informations->company = $request->input('user_company');
        $company_information->informations->address = $request->input('user_address');
        $company_information->informations->zip_code = $request->input('user_zipcode');
        $company_information->informations->save();

        return redirect('/view-user-profile');
    }

    public function update(Request $request)
    {
        #VALIDATION
        $this->validate($request,[
            'company_name'      => 'required',
            'company_address'   => 'required',
            'zip_code'          => 'required'
        ]);

        $user = User::find(auth()->user()->id);
        #post information details
        $informations = new Informations;
        $informations->branch_id = $request->input('branch_id');
        $informations->company = $request->input('company_name');
        $informations->address = $request->input('company_address');
        $informations->zip_code = $request->input('zip_code');
        $informations->save();

        $user->information_id = $information->id;
        $user->save();


        return redirect('headoffice.head-office-dashboard');
    }
    public function destroy($id)
    {
        //
    }

    public function about_client($id)
    {
         #AUTHORIZATION
        if(!Gate::allows('isSuperadmin') && !Gate::allows('isAdmin')){
            abort(404, "Sorry, You can't do this action");
        }
        #CREDENTIALS
        $clients = Credentials::find($id);
        $subscriptions = SubscriptionType::all();
        return view('admin.client-informations',['clients' => $clients, 'subscriptions' => $subscriptions]);
    }

    public function client_account_status($id)
    {
        $clients = Credentials::find($id);
        if($clients->users->status_id == 1){

            User::where('id', $clients->users->id)->update(['status_id' => 2]);
        }elseif($clients->users->status_id == 2){
            User::where('id', $clients->users->id)->update(['status_id' => 1]);
        }
        return back();

    }
    public function update_subscription(Request $request, $id)
    {
        $update = Credentials::where('id',$id)->update([

            'subscription'  => $request->input('client_sub'),

            'text_rate'     => $request->input('text_rate'),
        ]);

        return back();
    }
}
