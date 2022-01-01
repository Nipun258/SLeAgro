<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentTransferMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
         return $this->markdown('emails.payment_transfer',[ 'data' => $this->data])
               ->subject('SLeAgro Agricultural Product Transfer payment');
    }
}
