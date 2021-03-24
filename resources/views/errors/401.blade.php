@extends('layouts.app')

@section('page-title', __('error.401.page_title'))
@section('page-description', __('error.401.page_description'))

@section('content')
    <section class="content-noslide text-center contact-header" data-aos="fade-down" data-aos-delay="300">
        <h1 class="content-title" data-aos="fade">
            <span>@lang('error.401.page_title') </span>
        </h1>
    </section>
    <section class="container text-center margin-vertical-3">
        <p class="alert">{{ $exception->getMessage() }}</p>
        <a href="{{ route('home.index') }}">@lang('home.return')</a>
    </section>
@endsection
