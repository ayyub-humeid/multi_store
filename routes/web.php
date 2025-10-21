<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthentcationController;
use App\Http\Controllers\Front\Auth\TwoFactorAuthenticationController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\OrdersController;
use App\Http\Controllers\Front\PaymentsController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\StripeWebhooksController;
use App\Http\Middleware\SetAppLocale;
use Illuminate\Support\Facades\Route;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group([
//     'prefix' => LaravelLocalization::setLocale(),
// ], function() {
// Route::group([
 //     'prefix' => '{locale}',
 // ], functi

    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/products', [ProductsController::class, 'index'])
        ->name('front.products.index');

    Route::get('/products/{product:slug}', [ProductsController::class, 'show'])
        ->name('front.products.show');

    Route::resource('cart', CartController::class)->middleware(SetAppLocale::class);

    Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('checkout', [CheckoutController::class, 'store']);

    Route::get('auth/user/2fa',[TwoFactorAuthenticationController::class,'index'])->name('auth.2fa');
// });
// require __DIR__.'/auth.php';

require __DIR__ . '/dashboard.php';
