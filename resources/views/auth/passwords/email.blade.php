@extends('layouts.app')

@section('page-title', __('passwords.page_title.email'))
@section('page-description', __('passwords.page_description.email'))

@section('content')

    <div class="container-fluid header"></div>
    <div class="login-form">
        <h1 class="text-white m-5">Forgot Password</h1>
        <form class="submission-form container" method="POST" action="{{ route('password.email') }}">

            {{ csrf_field() }}

            <div>
                <input type="text" id="email" name="email" class="w-75 form-fill" placeholder="Email">
                <p id="email-help-text" class="help-text d-none"></p>
            </div>
            <p id="email-help-text" class="alert help-text hide"></p>

            <button type="submit" class="w-75 login-button text-uppercase">@lang('passwords.request_button')</button>

        </form>
    </div>
    <div class="d-flex justify-content-center fixed-bottom p-2">
        <img src="{{ asset('images/logo/global_carbon_holding_logo_small.png') }}">
    </div>

@endsection