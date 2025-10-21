<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {

        $products = Product::with('category')->active()
            //->latest()
            ->limit(8)
            ->orderByDesc('created_at')
            ->get();

        return view('front.home', compact('products'));
    }
}
