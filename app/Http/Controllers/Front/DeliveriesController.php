<?php

namespace App\Http\Controllers\Front;

use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\DeliveryLocationUpdated;

class DeliveriesController extends Controller
{
        public function show($id)
    {
        $delivery = Delivery::query()->select([
            'id',
            'order_id',
            'status',
            'lat',
            'lng',
        ])
        ->where('id', $id)
        ->firstOrFail();

        return $delivery;
    }

    public function update(Request $request, Delivery $delivery)
    {
        $request->validate([
            'lng' => ['required', 'numeric'],
            'lat' => ['required', 'numeric'],
        ]);

        $delivery->update([
            'lat'=>$request->lat,
            'lng'=>$request->lng,
        ]);

        event(new DeliveryLocationUpdated($delivery, $request->lat, $request->lng));

        return $delivery;
    }
}
