<?php

namespace App\Http\Middleware;

use Closure;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Soap\Url;
use Symfony\Component\HttpFoundation\Response;

class SetAppLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          $locale = request('locale',Cookie::get('locale'),config('app.locale'));
          
       
         Cookie::queue('locale',$locale,60*24);
// dd(Cookie::get('locale'));
        App::setLocale($locale);

        // Config::set('locale','ar');
        // Url::defaults([
        //     'locale'=>$locale
        // ]);
        // Route::current()->forgetParameter('locale');

        return $next($request);
    }
}