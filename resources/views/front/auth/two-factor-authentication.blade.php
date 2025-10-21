<x-front-layout title="Login">

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form style="text-align: center" class="card login-form" action="{{ route('two-factor.enable') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Two Factor Authentication</h3>
                                <p>You can enable 2FA.</p>
                            </div>
                            @if(session('status') =='two-factor-authentication-enabled')
                            <div class="mb-4 front-medium text-sm">
                                Please Finish Configure Two Factor Auth Below.
                            </div>
                            @endif
                            @if(!$user->two_factor_secret)
                            <div class="button">
                                <button class="btn" type="submit">Enable</button>
                            </div>
                            @else
                            <div class="button mb-3">

                                {!! $user->twoFactorQrCodeSvg() !!}
                                <div class="mt">
                                    <h4>Recovery Codes</h4>
                                    @foreach ($user->recoveryCodes() as $code )
                                    <li>{{ $code }}</li>
                                    @endforeach
                                </div>
                                @method("DELETE")
                                <button class="btn mt-4" type="submit">Disable</button>
                            </div>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->

</x-front-layout>
