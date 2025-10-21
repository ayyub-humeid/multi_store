<?php

namespace App\Http\Controllers\Front;

use Throwable;
use App\Models\Order;
use App\Models\OrderItem;
use App\Events\OrderCreated;
use App\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use App\Repositories\Cart\CartRepository;
use Mockery\Exception\InvalidOrderException;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart)
    {
        if ($cart->get()->count() == 0) {
            throw new InvalidOrderException('Cart is empty');
        }
        return view('front.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames(),
        ]);
    }

    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            'addr.billing.first_name' => ['required', 'string', 'max:255'],
            'addr.billing.last_name' => ['required', 'string', 'max:255'],
            'addr.billing.email' => ['required', 'string', 'max:255'],
            'addr.billing.phone_number' => ['required', 'string', 'max:255'],
            'addr.billing.city' => ['required', 'string', 'max:255'],
        ]);

        $items = $cart->get()->groupBy('product.store_id')->all();
        $total = 0;
        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {
                $total = 0;
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod',
                ]);

                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                    $total +=$item->quantity * $item->product->price;
                }


                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
                $order->total = $total;
                $order->save();
                // sleep(3);
            event(new OrderCreated($order));
            // sleep(5);

            }
                // Cart::empty();
                // event('order.created');

            DB::commit();



            // event(new OrderCreated($order));

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }


        // return redirect()->route('orders.payments.create', $order->id);
        return redirect()->route('home')->with('success','Saved Successfully');
    }
}