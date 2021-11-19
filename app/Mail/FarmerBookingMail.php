<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FarmerBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data; 
    }

    public function build()
    {
        return $this->markdown('emails.booking',[ 'data' => $this->data])
               ->subject('Appoinment Booking SLeAgro Agricultural Product Distribution System');
    }
}