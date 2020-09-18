<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Payment;
use App\Usage;
use App\Branch;
use App\Outbox;
use App\Credentials;
use App\SentMessage;
use App\Informations;
use App\Bills;
use DB;
use Carbon\Carbon;
use App;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function view_invoice_prepaid($id)
    {
        $users = auth()->user();
        $getUser_branch = Branch::all()->where('user_id', $users->id)->first();
        $getUser_credential = Credentials::where('id', $getUser_branch->credentials_id)->get();

        if($getUser_credential)
        {
            $getUser_payment = Payment::where('id', $id)->get();
            $get_branch = Branch::all();

            for ($b=0; $b < count($get_branch); $b++)
            {
                $get_invoice = Invoice::all();

                for ($i=0; $i < count($get_invoice); $i++)
                {
                    if($get_invoice[$i]['id'] == $id)
                    {
                        $count_outbox = Outbox::where('invoice_number', $get_invoice[$i]['invoice_number'])->where('branch_id', $get_branch[$b]['branch_id'])->where('credentials_id', $get_branch[$b]['credentials_id'])->get();
                            $get_branch[$b]['count'] = count($count_outbox);
                    }
                }
            }
                $pdf = App::make('dompdf.wrapper');
                $pdf->loadView('pdf/pdfView', compact('users', 'getUser_credential', 'get_branch', 'getUser_payment'));
                return $pdf->stream('invoice.pdf');
        }
    }

    public function view_invoice_postpaid($id)
    {
        $bills = Bills::findOrFail($id);
        $users = auth()->user();
        $getUser_branch = Branch::all()->where('user_id', $users->id)->first(); #get authenticated branch
        $getUser_credential = Credentials::where('id', $getUser_branch->credentials_id)->get(); #get authenticated branch credentials for main

        if($getUser_credential)
        {
            $getUser_payment = Payment::where('id', $id)->get();
            foreach($getUser_payment as $gp)
            {
                $get_branch = Branch::where('credentials_id', $gp->credentials_id)->get(); #getting branch ID credentials per user
                $get_invoice = Invoice::where('payment_id', $gp->id)->orderBy('id', 'desc')->get(); #getting individual invoice number

            }

            #counting total messages in outbox using invoice number
            for($i=0; $i < count($get_invoice); $i++){
                $count_outbox = Outbox::where('invoice_number', $get_invoice[$i]['invoice_number'])->get();
                 $get_invoice[$i]['count'] = count($count_outbox);


            }

            #counting messages per branch usage
            for($b=0; $b < count($get_branch); $b++){
                   for ($in=0; $in < count($get_invoice); $in++) {
                            $outbox_count = Outbox::where('invoice_number', $get_invoice[$in]['invoice_number'])->where('branch_id', $get_branch[$b]['branch_id'])                            ->get();
                            $full_message = SentMessage::where('invoice_number', $get_invoice[$in]['invoice_number'])->where('branch_id', $get_branch[$b]['branch_id'])                            ->get();
                            $get_branch[$b]['count'] = count($outbox_count);
                            $get_branch[$b]['full_message'] = count($full_message);

                        }
            }



                $pdf = App::make('dompdf.wrapper');
                $pdf->loadView('pdf/postinvoice', compact('users', 'getUser_credential', 'get_branch', 'getUser_payment', 'get_invoice', 'bills'));
                return $pdf->stream('invoice.pdf');
        }
    }
}
