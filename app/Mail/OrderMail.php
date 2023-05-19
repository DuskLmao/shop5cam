<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\ProductDetail;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $productDetails;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $title = "Chi tiết giao dịch #" . $this->order->id;
        $order = Order::find($this->order->id);

        $productDetails = array();
        $productDetailIds = json_decode($order->product_details_id);
        foreach ($productDetailIds as $productDetailId) {
            $productDt = ProductDetail::find($productDetailId);
            array_push($productDetails, $productDt);
        }
        $this->productDetails = $productDetails;
        return $this
            ->to(auth()->user()->email)
            ->subject("Chi tiết đơn hàng #" . $this->order->id)
            ->view('emails.order')
            ->with(['productDetails' => $this->productDetails]);
    }
}
