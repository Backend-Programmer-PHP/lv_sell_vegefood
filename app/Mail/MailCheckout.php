<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Modules\Site\Models\Order_Model;

class MailCheckout extends Mailable
{
    use Queueable, SerializesModels;
    public $orderId;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderId)
    {
        $this->orderId=$orderId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order=Order_Model::getAllOrder($this->orderId);
        return $this->view('page.pdf',compact('order',$order));
    }
}
