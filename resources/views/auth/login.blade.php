@extends('layouts.web.app')

@section('content')


    <div class="main-padding d-flex justify-content-center align-items-center mb-5">

        <div class="container-fluid p-5">
            <div class="row align-items-center justify-content-between register">
                <!-- LEAD TEXT -->
                <div class="col-12 col-lg-6   px-0 px-sm-5">
                    <div class="card text-primary shadow-md white-text shadow-md px-0 mx-0">
                        <div class="card-body p-5">
                            {{Form::open(['url' => route('login'),'id'=>'leadForm','class'=>'register-form', '_method'=>'POST'] )}}
                            @csrf

                            <h3 class="text-left wow fadeInLeft" data-wow-delay=".3s">
                                {!! __('web/login.title') !!}
                            </h3>
                            <div class="text-center pt-3">
                                <img src="https://cdn.veltacorp.com/img/velta_logo.png"
                                     class="img-fluid wow swing center" alt="Velta"
                                     style="animation-iteration-count: 1; animation-name: swing;">
                            </div>
                            <div class="p-0">
                                <!-- Email -->
                                <div class="md-form">
                                    <i class="fa fa-envelope prefix"></i>
                                    <input id="materialLoginFormEmail" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email"
                                           autofocus>
                                    <label for="materialLoginFormEmail">{{ __('E-Mail Address') }}</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="md-form">
                                    <i class="fa fa-lock prefix"></i>
                                    <input id="materialLoginFormPassword" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="current-password">
                                    <label for="materialLoginFormPassword">{{ __('Password') }}</label>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-start">
                                    <div>
                                        <!-- Remember me -->
                                        <div class="form-check">
                                            <input class="form-check-input color" type="checkbox"
                                                   name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label text-secondary"
                                                   for="remember">{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>
                                    <div>
                                        <!-- Forgot password -->
                                        {{--
                                        @if (Route::has('password.request'))
                                            <a  href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                        --}}
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a  href="{{ route('register') }}" class="text-lime-green">
                                    {!! __('Sign up') !!}
                                </a>
                            </div>
                            <button type="submit"
                                    class="btn btn-primary btn-lg btn-block btn-rounded
                                    font-weight-bold waves-effect mt-5">
                                {{ __('Login') }}
                            </button>

                            {{Form::close()}}
                        </div>
                    </div>
                </div>
                <!-- END LEAD TEXT -->

                <!-- REGISTER FORM -->
                <div class="col-12 col-lg-6  mt-5 mt-lg-0 px-0 px-sm-5 d-none d-sm-block">
                    <div class="card bg-transparent shadow-md white-text shadow-none  wow fadeInRight" data-wow-delay=".3s">
                        <div class="card-body py-5 px-4  px-sm-5 text-right">
                            <img src="https://cdn.veltacorp.com/img/velta_app.png" class="img-fluid" alt="404 error">
                        </div>
                    </div>
                </div>
                <!-- END REGISTER FORM -->
            </div>
        </div>
    </div>
@endsection
