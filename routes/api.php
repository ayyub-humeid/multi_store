<?php


use App\Http\Controllers\Api\DeliveriesController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AccessTokensController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth::guard('sanctum')->user();
});

Route::apiResource('products',ProductController::class);

Route::post('auth/access-tokens',[AccessTokensController::class,'store'])->middleware('guest:sanctum');
Route::delete('auth/access-tokens/{token?}',[AccessTokensController::class,'destroy'])->middleware('auth:sanctum');