<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationRejectMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $quotation_update;
    private $user;

    public function __construct($quotation_update, $user )
    {
        $this->quotation_update = $quotation_update;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $user =  $this->user;
        $quotation_update = $this->quotation_update;
        
        return $this->view('mail.reject',compact('user','quotation_update'))->subject("Quotation Reject");
    }
}
