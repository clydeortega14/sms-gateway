<?php

namespace App\Http\Traits;
use App\Outbox;

trait BranchListTrait {


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
}