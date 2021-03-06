<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data; 
    }

    public function build()
    {
        return $this->markdown('emails.contact_message',[ 'data' => $this->data])
               ->subject('Appoinment Booking SLeAgro Agricultural Product Distribution System');
    }
}
