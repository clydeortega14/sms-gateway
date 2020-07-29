<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReceiptStatement extends Mailable
{
    use Queueable, SerializesModels;

     public $user;
     public $receipt;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $receipt)
    {
        $this->user = $user;
        $this->receipt  = $receipt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@coredev.ph')
        ->view('emails.receipt');
    }
}
