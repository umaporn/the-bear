@extends('layouts.app')
@section('page-title',__('passwords.page_title.reset'))
@section('content')

    <div class="container-fluid header"></div>
    <div class="login-form">
        <h1 class="text-white m-4">@lang('passwords.password_reset_form.heading')</h1>
        <form class="submission-form container" method="POST" action="{{ route('password.change') }}">

            {{ csrf_field() }}

            <div>
                <input type="text" id="email" name="email" class="w-75 form-fill" placeholder="Email">
                <p id="email-help-text" class="help-text d-none"></p>
            </div>

            <div>
                <input type="password" name="password" id="password" class="w-75 form-fill" placeholder="Password" required>
                <p id="password-help-text" class="help-text help-text d-none"></p>
            </div>

            <div>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-75 form-fill" placeholder="Conform Password" required>
                <p id="password_confirmation-help-text" class="help-text help-text d-none"></p>
            </div>
            <input type="hidden" name="token" value="{{ $token }}">
            <button type="submit" class="w-75 login-button text-uppercase">@lang('passwords.password_reset_form.button')</button>

        </form>
    </div>
    <div class="d-flex justify-content-center fixed-bottom p-2">
        <img src="{{ asset('images/logo/global_carbon_holding_logo_small.png') }}">
    </div>

@endsection
