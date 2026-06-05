<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Mail\Mailable;

class InvoiceCreatedMail extends Mailable
{
    public function __construct(public Order $order)
    {
    }

    public function build()
    {
        return $this->subject('Invoice Pembayaran Winnefly Pastries')
            ->view('emails.invoice-created');
    }
}