<?php

namespace App\Observers;

use App\Mail\OrderUpdated;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;


class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \App\Models\Order $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \App\Models\Order $order
     * @return void
     */
    public function updated(Order $order)
    {
        if ($order->status == 20) {
            $partnerEmail = $order->partner->email;
            $vendorsEmail = $order->orderProducts->map(function ($item) {
                return $item->product->vendor->email;
            });
            $emails = [$partnerEmail];
            foreach ($vendorsEmail as $email) {
                $emails[] = $email;
            }
            foreach ($emails as $email) {
                Mail::to($email)->queue(new OrderUpdated($order));
            }
        }
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  \App\Models\Order $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  \App\Models\Order $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  \App\Models\Order $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
