@extends('layouts.app')

@section('page-title', __('login.page_title.index'))
@section('page-description', __('login.page_description.index'))

@section('content')

    <div class="container-fluid header"></div>

    <div class="login-form p-2" id="login-with-email">
        {{--        <h1 class="text-white">Login</h1>--}}
        <div class="row p-4">
            <div class="col-md-6 border-login">
                <h4 class="text-white">Login With E-mail</h4>
                <form class="submission-form container" method="POST" action="{{ route('submitLogin') }}">
                    {{ csrf_field() }}
                    <div class="d-flex flex-column">
                        <div>
                            <input type="text" id="email" name="email" class="w-75 form-fill" placeholder="Email">
                            <p id="email-help-text" class="help-text d-none"></p>
                        </div>
                        <div class="toggle-password">
                            <input type="password" id="password" name="password" class="w-75 form-fill password" placeholder="Password">
                            <span id="password-field" class="field-icon">
                        <i class="fa fa-eye"></i>
                    </span>
                            <p id="password-help-text" class="alert help-text d-none"></p>
                        </div>
                        <div>
                            <button type="submit" class="w-75 login-button text-uppercase">@lang('login.login_button')</button>
                            <div class="text-white">
                                <small><a href="{{ route('password.request') }}" class="text-white"> Forgot
                                                                                                  password? </a>
                                </small>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6" id="login-with-oreid">
                <div class="row d-flex flex-column">
                    <h4 class="text-white">Signup/Login With Social Account</h4>
                </div>
                <div class="d-flex flex-column">
                    <div class="d-flex flex-column text-center">
                        <div class="col m-2" style="width:100%">
                            <a href="{{ config('url.authen.facebook') }}" class="fb btn">
                                <i class="fa fa-facebook fa-fw"></i> Facebook
                            </a>
                        </div>
                        <div class="col m-2">
                            <a href="{{ config('url.authen.twitter') }}" class="twitter btn">
                                <i class="fa fa-twitter fa-fw"></i> Twitter
                            </a>
                        </div>
                        <div class="col m-2">
                            <a href="{{ config('url.authen.google') }}" class="google btn"><i class="fa fa-google fa-fw">
                                </i> Google
                            </a>
                        </div>
                    </div>
                    <div class="text-white">
                        <small>
                            <a href="{{ route('register') }}" class="text-white"> Sign Up with E-Mail</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center fixed-bottom p-2">
        <img src="{{ asset('images/logo/global_carbon_holding_logo_small.png') }}">
    </div>


    <!-- Modal -->
    <div class="modal fade" id="login-error" tabindex="-1" aria-labelledby="loginSelectionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        This user have been register with email.<p>
                        Please Try to login with your email again.
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
