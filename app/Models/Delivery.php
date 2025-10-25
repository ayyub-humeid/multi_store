<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
     protected $fillable = ['order_id', 'status', 'lat', 'lng'];

    // Optional: get location as array
    public function getLocationAttribute()
    {
        return [
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }
}