@extends('layouts.app')

@section('page-title', __('register.page_title.index'))
@section('page-description', __('register.page_description.index'))

@section('content')

    <div class="container-fluid header"></div>
    <div class="login-form" style="width:40% !important">
        <h1 class="text-white m-5">Sign Up</h1>
        <form class="submission-form container" method="POST" action="{{ route('submitRegister') }}">
            {{ csrf_field() }}
            <div class="d-flex flex-column">
                <div>
                    <input type="text" id="email" name="email" class="w-75 form-fill" placeholder="Email">
                    <div id="email-help-text" class="text-danger help-text d-none"></div>
                </div>
                <div class="toggle-password">
                    <input type="password" id="password" name="password" class="w-75 form-fill password" placeholder="Password">
                    <span id="password-field" class="field-icon">
                        <i class="fa fa-eye"></i>
                    </span>
                    <div id="password-help-text" class="text-danger help-text d-none"></div>
                </div>
                <div>
                    <button type="submit" class="w-75 login-button text-uppercase">Sign Up</button>
                </div>
            </div>
        </form>
        <div class="text-white">
            <small>
                <a href="{{ route('login') }}" class="text-white"> Sign Up with Social Media</a>
            </small>
        </div>
    </div>
    <div class="d-flex justify-content-center fixed-bottom p-2">
        <img src="{{ asset('images/logo/global_carbon_holding_logo_small.png') }}">
    </div>
@endsection