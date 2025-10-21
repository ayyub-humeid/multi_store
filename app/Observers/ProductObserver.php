<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductObserver
{
      public function creating(Product $product)
    {

       $user = Auth::user();
       if($user && $user->store_id){
        $product->store_id = $user->store_id;
       }
       $slug = Str::slug($product->name);
       $product->slug = $slug;

    }

}
