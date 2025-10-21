<?php

namespace App\Providers;

use App\Actions\Fortify\AuthenticateUser;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         $request = request();
        if($request->is('admin/*')){

            Config::set('fortify.guard','admin');
            Config::set('passwords','admins');
            Config::set('fortify.prefix','admin');
            Config::set('fortify.home','/admin/dashboard');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);



        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        // Fortify::viewPrefix('auth.');
        Fortify::confirmPasswordView('front.auth.confirm-password');
        Fortify::twoFactorChallengeView('front.auth.two-factor-challenge');
        if(Config::get('fortify.guard') =='admin'){
        Fortify::authenticateUsing( [ new AuthenticateUser,'authenticate']);

            Fortify::loginView('auth.login');
        }else{
            Fortify::loginView('front.auth.login');
        }
        // Fortify::loginView('auth.login');
        // Fortify::requestPasswordResetLinkView(function(){
        //     return view('auth.forgot-password');
        // });
    }
}