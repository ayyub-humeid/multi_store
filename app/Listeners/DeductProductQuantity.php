<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Throwable;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->order;

        // dd($order);
        // UPDATE products SET quantity = quantity - 1

            // foreach (Cart::get() as $item) {
            //      Product::where('id',$item->product_id)
            //     ->update([
            //         'quantity'=> DB::raw("quantity - {$item->quantity}")
            //     ]);
            // dd($order->products);
            foreach($order->products as $product){

                $product->decrement('quantity',$product->order_item->quantity);
            }
                // $product->decrement('quantity', $product->order_item->quantity);

                // Product::where('id', '=', $item->product_id)
                //     ->update([
                //         'quantity' => DB::raw("quantity - {$item->quantity}")
                //     ]);
            // }

    }
}