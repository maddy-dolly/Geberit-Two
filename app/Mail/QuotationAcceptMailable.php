<?php
 
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Quotation;
use App\ProductQuotation;
use PDF;


class QuotationAcceptMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $quotation;
    private $user;
    public function __construct($user,$quotation)
    {
        $this->quotation = $quotation;
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
        $quotation = $this->quotation;
        $data['quotation'] = Quotation::with('customer','user')->find($quotation->id);
        $data['quotation1'] = ProductQuotation::with('product')->where('quotations_id',$quotation->id)->get();
        $pdf = PDF::loadView('exports.user_pdf', $data); 
        $save = $pdf->download('user.pdf');
        /* return $this->view('exports.user_pdf')
        ->attachData($this->$data, 'user-invoice.pdf', [
            'mime' => 'application/pdf',
        ]); */
        
        return $this->view('mail.accept',compact('user','quotation'))->subject("Quotation Accept")->attachData($save, 'user-invoice.pdf', [
            'mime' => 'application/pdf',
        ]);
    }
}
